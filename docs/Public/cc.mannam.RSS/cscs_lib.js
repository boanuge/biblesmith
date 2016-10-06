//#####################################################################################################
// March 26, 2006
// Richard Greenwood
//
// August 22, 2006
// aero   Fixed the problem in 7 parameter datum shift

/**
  cscs.js is loosely based on PROJ.4 program cs2cs

*/

var PI = Math.PI;
var HALF_PI=PI*0.5;
var TWO_PI=PI*2;
var R2D=57.2957795131;
var D2R=0.0174532925199;
var EPSLN = 1.0e-10;
var SRS_WGS84_SEMIMAJOR=6378137.0;  // only used in grid shift transforms

/* SEC_TO_RAD = Pi/180/3600 */
var SEC_TO_RAD = 4.84813681109535993589914102357e-6

/* datum_type values */
var PJD_UNKNOWN  = 0;
var PJD_3PARAM   = 1;
var PJD_7PARAM   = 2;
var PJD_GRIDSHIFT= 3;
var PJD_WGS84    = 4;   // WGS84 or equivelent

var csErrorMessage = "";

/** point object, nothing fancy, just allows values to be
    passed back and forth by reference rather than by value.
*/
function PT(x,y) {
  this.x=x;
  this.y=y;
  this.z=0.0;
}

/**
  csList is a collection of coordiante system objects
  generally a CS is added by means of a separate .js file for example:

    <SCRIPT type="text/javascript" src="defs/EPSG26912.js"></SCRIPT>

*/
var csList = new Object();

// These are so widely used, we'll go ahead and throw them in
// without requiring a separate .js file
csList.EPSG4326 = "+title=long / lat WGS84 +proj=longlat";  // +a=6378137.0 +b=6356752.31424518"; //  +ellps=WGS84 +datum=WGS84";
csList.EPSG4269 = "+title=long / lat NAD83 +proj=longlat";  // +a=6378137.0 +b=6356752.31414036"; //  +ellps=GRS80 +datum=NAD83";

/**
  Coordinate System constructor
  def is a CS definition in PROJ.4 format, for example:
    +proj="tmerc"   //longlat, etc.
    +a=majorRadius
    +b=minorRadius
    +lat0=somenumber
    +long=somenumber
*/
function CS(def) {
  if(!def) {  // def is optional, if not provided, default to longlat WGS84
    var def = csList.EPSG4326;
    csErrorMessage += "No coordinate system definition provided, assuming longlat WGS83";
  }
  var paramName, paramVal;
  var paramArray=def.split("+");

  for (var prop=0; prop<paramArray.length; prop++)
  {
    property = paramArray[prop].split("=");
    paramName= property[0].toLowerCase();
    paramVal = property[1];

    switch (paramName.replace(/\s/gi,""))   // trim out spaces
    {
      case "": break;   // throw away nameless parameter
      case "title": this.title =paramVal; break;
      case "proj":  this.proj =  paramVal.replace(/\s/gi,""); break;
      // case "ellps": this.ellps = paramVal.replace(/\s/gi,""); break;
      // case "datum": this.datum = paramVal.replace(/\s/gi,""); break;
      case "a":     this.a =  parseFloat(paramVal);  break; // semi-major radius
      case "b":     this.b =  parseFloat(paramVal);  break; // semi-minor radius
      case "lon_0": this.long0= paramVal*D2R; break;        // lam0, central longitude
      case "lat_0": this.lat0 = paramVal*D2R; break;        // phi0, central latitude
      case "x_0":   this.x0 = parseFloat(paramVal); break;  // false easting
      case "y_0":   this.y0 = parseFloat(paramVal); break;  // false northing
      case "k":     this.k0 = parseFloat(paramVal); break;  // projection scale factor
      //case "to_meter": this.to_meter = parseFloat(paramVal); break; // cartesian scaling
      case "to_meter": this.to_meter = eval(paramVal); break; // cartesian scaling
      case "zone":     this.zone =  parseInt(paramVal); break;      // UTM Zone
      case "towgs84":  this.datum_params = paramVal.split(","); break;
      case "from_greenwich": this.from_greenwich = paramVal*D2R; break;
      default: csErrorMessage += "\nUnrecognized parameter: " + paramName;
    } // switch()
  } // for paramArray


  if (this.datum_params)  {
    for (var i=0; i<this.datum_params.length; i++)
      this.datum_params[i]=parseFloat(this.datum_params[i]);
    if (this.datum_params[0] != 0 ||
        this.datum_params[1] != 0 ||
        this.datum_params[2] != 0 )
      this.datum_type = PJD_3PARAM;
    if (this.datum_params.length > 3)
    {
      if (this.datum_params[3] != 0 ||
          this.datum_params[4] != 0 ||
          this.datum_params[5] != 0 ||
          this.datum_params[6] != 0 )
      {
        this.datum_type = PJD_7PARAM;

        this.datum_params[3] *= SEC_TO_RAD;
        this.datum_params[4] *= SEC_TO_RAD;
        this.datum_params[5] *= SEC_TO_RAD;
        this.datum_params[6] = (this.datum_params[6]/1000000.0) + 1.0;
      }
    }
  }

  if (!this.datum_type)
    this.datum_type = PJD_WGS84;

  /* ********************
    should look for errors here,
      required for longlat:
        proj, datum_type
      additional requirements for projected CSs:
        Forward(), Inverse(), Inint()
  ********************* */

  if (!this.a) {    // do we have an ellipsoid?
    this.a = 6378137.0;
    this.b = 6356752.31424518;
    csErrorMessage += "\nEllipsoid parameters not provided, assuming WGS84";
  }
  this.a2 = this.a * this.a;          // used in geocentric
  this.b2 = this.b * this.b;          // used in geocentric
  this.es=(this.a2-this.b2)/this.a2;  // e ^ 2
    //this.es=1-(Math.pow(this.b,2)/Math.pow(this.a,2));
  this.e = Math.sqrt(this.es);        // eccentricity
  this.ep2=(this.a2-this.b2)/this.b2; // used in geocentric

  if (this.proj != "longlat") {    // The Forward, Inverse, and Initilization functions are derived from the projection name.
    this.Forward = eval(this.proj+"Fwd");
    this.Inverse = eval(this.proj+"Inv"); // name of inverse function (x/y to long/lat)
    this.Init  =  eval(this.proj+"Init"); // initilization function
    this.Init(this);
  }

} // CS constructor


/************************************************************************************/

/** cs_transform()
  main entry point
  source coordinate system definition,
  destination coordinate system definition,
  point to transform, may be geodetic (long, lat)
    or projected Cartesian (x,y)
*/
function cs_transform(srcdefn, dstdefn, point) {
  pj_errno = 0;

    // Transform source points to long/lat, if they aren't already.
  if( srcdefn.proj=="longlat") {
    point.x *=D2R;  // convert degrees to radians
    point.y *=D2R;
  } else {
    if (srcdefn.to_meter) {
      point.x *= srcdefn.to_meter;
      point.y *= srcdefn.to_meter;
    }
    srcdefn.Inverse(point); // Convert Cartesian to longlat
  }

    // Adjust for the prime meridian if necessary
  if( srcdefn.from_greenwich) { point.x += srcdefn.from_greenwich; }

    // Convert datums if needed, and if possible.
  if( cs_datum_transform( srcdefn, dstdefn, point) != 0 )
    return pj_errno;

    // Adjust for the prime meridian if necessary
  if( dstdefn.from_greenwich ) { point.x -= dstdefn.from_greenwich; }

  if( dstdefn.proj=="longlat" )
  {             // convert radians to decimal degrees
    point.x *=R2D;
    point.y *=R2D;
  } else  {               // else project
    dstdefn.Forward(point);
    if (dstdefn.to_meter) {
      point.x /= dstdefn.to_meter;
      point.y /= dstdefn.to_meter;
    }
  }
} // cs_transform()



/** cs_datum_transform()
  source coordinate system definition,
  destination coordinate system definition,
  point to transform in geodetic coordinates (long, lat, height)
*/
function cs_datum_transform( srcdefn, dstdefn, point )
{

    // Short cut if the datums are identical.
  if( cs_compare_datums( srcdefn, dstdefn ) )
      return 0; // in this case, zero is sucess,
                // whereas cs_compare_datums returns 1 to indicate TRUE
                // confusing, should fix this

// #define CHECK_RETURN {if( pj_errno != 0 ) { if( z_is_temp ) pj_dalloc(z); return pj_errno; }}


    // If this datum requires grid shifts, then apply it to geodetic coordinates.
    if( srcdefn.datum_type == PJD_GRIDSHIFT )
    {
      alert("ERROR: Grid shift transformations are not implemented yet.");
      /*
        pj_apply_gridshift( pj_param(srcdefn.params,"snadgrids").s, 0,
                            point_count, point_offset, x, y, z );
        CHECK_RETURN;

        src_a = SRS_WGS84_SEMIMAJOR;
        src_es = 0.006694379990;
      */
    }

    if( dstdefn.datum_type == PJD_GRIDSHIFT )
    {
      alert("ERROR: Grid shift transformations are not implemented yet.");
      /*
        dst_a = ;
        dst_es = 0.006694379990;
      */
    }

      // Do we need to go through geocentric coordinates?
//  if( srcdefn.es != dstdefn.es || srcdefn.a != dstdefn.a || // RWG - removed ellipse comparison so
    if( srcdefn.datum_type == PJD_3PARAM                      // that longlat CSs do not have to have
        || srcdefn.datum_type == PJD_7PARAM                   // an ellipsoid, also should put it a
        || dstdefn.datum_type == PJD_3PARAM                   // tolerance for es if used.
        || dstdefn.datum_type == PJD_7PARAM)
    {

      // Convert to geocentric coordinates.
      cs_geodetic_to_geocentric( srcdefn, point );
      // CHECK_RETURN;

      // Convert between datums
      if( srcdefn.datum_type == PJD_3PARAM || srcdefn.datum_type == PJD_7PARAM )
      {
        cs_geocentric_to_wgs84( srcdefn, point);
        // CHECK_RETURN;
      }

      if( dstdefn.datum_type == PJD_3PARAM || dstdefn.datum_type == PJD_7PARAM )
      {
        cs_geocentric_from_wgs84( dstdefn, point);
        // CHECK_RETURN;
      }

      // Convert back to geodetic coordinates
      cs_geocentric_to_geodetic( dstdefn, point );
        // CHECK_RETURN;
    }


  // Apply grid shift to destination if required
  if( dstdefn.datum_type == PJD_GRIDSHIFT )
  {
    alert("ERROR: Grid shift transformations are not implemented yet.");
    // pj_apply_gridshift( pj_param(dstdefn.params,"snadgrids").s, 1, point);
    // CHECK_RETURN;
  }
  return 0;
} // cs_datum_transform


/****************************************************************/
// cs_compare_datums()
//   Returns 1 (TRUE) if the two datums match, otherwise 0 (FALSE).
function cs_compare_datums( srcdefn, dstdefn )
{
  if( srcdefn.datum_type != dstdefn.datum_type )
  {
    return 0; // false, datums are not equal
  }
  /*  RWG - took this out so that ellipse is not required for longlat CSs
  else if( srcdefn.a != dstdefn.a
           || Math.abs(srcdefn.es - dstdefn.es) > 0.000000000050 )
  {
    // the tolerence for es is to ensure that GRS80 and WGS84
    // are considered identical
    return 0;
  }
  */
  else if( srcdefn.datum_type == PJD_3PARAM )
  {
    return (srcdefn.datum_params[0] == dstdefn.datum_params[0]
            && srcdefn.datum_params[1] == dstdefn.datum_params[1]
            && srcdefn.datum_params[2] == dstdefn.datum_params[2]);
  }
  else if( srcdefn.datum_type == PJD_7PARAM )
  {
    return (srcdefn.datum_params[0] == dstdefn.datum_params[0]
            && srcdefn.datum_params[1] == dstdefn.datum_params[1]
            && srcdefn.datum_params[2] == dstdefn.datum_params[2]
            && srcdefn.datum_params[3] == dstdefn.datum_params[3]
            && srcdefn.datum_params[4] == dstdefn.datum_params[4]
            && srcdefn.datum_params[5] == dstdefn.datum_params[5]
            && srcdefn.datum_params[6] == dstdefn.datum_params[6]);
  }
  else if( srcdefn.datum_type == PJD_GRIDSHIFT )
  {
    return strcmp( pj_param(srcdefn.params,"snadgrids").s,
                   pj_param(dstdefn.params,"snadgrids").s ) == 0;
  }
  else
    return 1; // true, datums are equal
} // cs_compare_datums()
//#####################################################################################################



//#####################################################################################################
// following functions from gctpc cproj.c for transverse mercator projections
function e0fn(x){return(1.0-0.25*x*(1.0+x/16.0*(3.0+1.25*x)));}
function e1fn(x){return(0.375*x*(1.0+0.25*x*(1.0+0.46875*x)));}
function e2fn(x){return(0.05859375*x*x*(1.0+0.75*x));}
function e3fn(x){return(x*x*x*(35.0/3072.0));}
function mlfn(e0,e1,e2,e3,phi){return(e0*phi-e1*Math.sin(2.0*phi)+e2*Math.sin(4.0*phi)-e3*Math.sin(6.0*phi));}

// Function to adjust longitude to -180 to 180; input in radians
function adjust_lon(x) {x=(Math.abs(x)<PI)?x:(x-(sign(x)*TWO_PI));return(x);}
// Function to return the sign of an argument
function sign(x) { if (x < 0.0) return(-1); else return(1);}

/**
  Initialize Transverse Mercator projection
*/


function tmercInit(def)  {
  def.e0 = e0fn(def.es);
  def.e1 = e1fn(def.es);
  def.e2 = e2fn(def.es);
  def.e3 = e3fn(def.es);
  def.ml0 = def.a * mlfn(def.e0, def.e1, def.e2, def.e3, def.lat0);
  def.ind = (def.es < .00001) ? 1 : 0; // spherical?
}


/**
  Initialize UTM projection
*/
function utmInit(def) {
  def.lat0 = 0.0;
  def.long0 = ((6 * Math.abs(def.zone)) - 183) * D2R;
  def.x0 = 500000.0;
  def.y0 = (def.zone < 0) ? 10000000.0 : 0.0;
  if (!def.k0)
    def.k0 = 0.9996;
  tmercInit(def);
} // utminit()


/**
  Transverse Mercator Forward  - long/lat to x/y
  long/lat in radians
*/
function tmercFwd(p) {
//this.k0
  var delta_lon = adjust_lon(p.x - this.long0); // Delta longitude
  var con;    // cone constant
  var x, y;
  var sin_phi=Math.sin(p.y);
  var cos_phi=Math.cos(p.y);

  if (this.ind != 0) {  /* spherical form */
    var b = cos_phi * Math.sin(delta_lon);
    if ((Math.abs(Math.abs(b) - 1.0)) < .0000000001)  {
      alert("Error in ll2tm(): Point projects into infinity");
      return(93);
    } else {
      x = .5 * this.a * this.k0 * Math.log((1.0 + b)/(1.0 - b));
      con = Math.acos(cos_phi * Math.cos(delta_lon)/Math.sqrt(1.0 - b*b));
      if (p.y < 0)
        con = - con;
      y = this.a * this.k0 * (con - this.lat0);
    }
  } else {
    var al  = cos_phi * delta_lon;
    var als = Math.pow(al,2);
    var c   = this.ep2 * Math.pow(cos_phi,2);
    var tq  = Math.tan(p.y);
    var t   = Math.pow(tq,2);
    con = 1.0 - this.es * Math.pow(sin_phi,2);
    var n   = this.a / Math.sqrt(con);
    var ml  = this.a * mlfn(this.e0, this.e1, this.e2, this.e3, p.y);

    x = this.k0 * n * al * (1.0 + als / 6.0 * (1.0 - t + c + als / 20.0 * (5.0 - 18.0 * t + Math.pow(t,2) + 72.0 * c - 58.0 * this.ep2))) + this.x0;
    y = this.k0 * (ml - this.ml0 + n * tq * (als * (0.5 + als / 24.0 * (5.0 - t + 9.0 * c + 4.0 * Math.pow(c,2) + als / 30.0 * (61.0 - 58.0 * t + Math.pow(t,2) + 600.0 * c - 330.0 * this.ep2))))) + this.y0;

  }
  p.x=x;
  p.y=y;
} // tmercFwd()

var utmFwd = tmercFwd;

/**
  Transverse Mercator Inverse  -  x/y to long/lat
*/
function tmercInv(p) {
  var con, phi;  /* temporary angles       */
  var delta_phi; /* difference between longitudes    */
  var i;
  var max_iter = 6;      /* maximun number of iterations */
  var lat, lon;

  if (this.ind != 0) {   /* spherical form */
    var f = exp(p.x/(this.a * this.k0));
    var g = .5 * (f - 1/f);
    var temp = this.lat0 + p.y/(this.a * this.k0);
    var h = cos(temp);
    con = sqrt((1.0 - h * h)/(1.0 + g * g));
    lat = asinz(con);
    if (temp < 0)
      lat = -lat;
    if ((g == 0) && (h == 0)) {
      lon = this.long0;
    } else {
      lon = adjust_lon(atan2(g,h) + this.long0);
    }
  } else {    // ellipsoidal form
    p.x -= this.x0;
    p.y -= this.y0;

    con = (this.ml0 + p.y / this.k0) / this.a;
    phi = con;
    for (i=0;;i++) {
      delta_phi=((con + this.e1 * Math.sin(2.0*phi) - this.e2 * Math.sin(4.0*phi) + this.e3 * Math.sin(6.0*phi)) / this.e0) - phi;
      phi += delta_phi;
      if (Math.abs(delta_phi) <= EPSLN) break;
      if (i >= max_iter) {
        alert ("Error in tm2ll(): Latitude failed to converge");
        return(95);
      }
    } // for()
    if (Math.abs(phi) < HALF_PI) {
      // sincos(phi, &sin_phi, &cos_phi);
      var sin_phi=Math.sin(phi);
      var cos_phi=Math.cos(phi);
      var tan_phi = Math.tan(phi);
      var c = this.ep2 * Math.pow(cos_phi,2);
      var cs = Math.pow(c,2);
      var t = Math.pow(tan_phi,2);
      var ts = Math.pow(t,2);
      con = 1.0 - this.es * Math.pow(sin_phi,2);
      var n = this.a / Math.sqrt(con);
      var r = n * (1.0 - this.es) / con;
      var d = p.x / (n * this.k0);
      var ds = Math.pow(d,2);
      lat = phi - (n * tan_phi * ds / r) * (0.5 - ds / 24.0 * (5.0 + 3.0 * t + 10.0 * c - 4.0 * cs - 9.0 * this.ep2 - ds / 30.0 * (61.0 + 90.0 * t + 298.0 * c + 45.0 * ts - 252.0 * this.ep2 - 3.0 * cs)));
      lon = adjust_lon(this.long0 + (d * (1.0 - ds / 6.0 * (1.0 + 2.0 * t + c - ds / 20.0 * (5.0 - 2.0 * c + 28.0 * t - 3.0 * cs + 8.0 * this.ep2 + 24.0 * ts))) / cos_phi));
    } else {
      lat = HALF_PI * sign(p.y);
      lon = this.long0;
    }
  }
  p.x=lon;
  p.y=lat;
} // tmercInv()

var utmInv = tmercInv;
//#####################################################################################################



//#####################################################################################################
/*
Author:       Richard Greenwood rich@greenwoodmap.com
License:      LGPL as per: http://www.gnu.org/copyleft/lesser.html
*/

/**
 * convert between geodetic coordinates (longitude, latitude, height)
 * and gecentric coordinates (X, Y, Z)
 * ported from Proj 4.9.9 geocent.c
*/


// following constants #define'd in geocent.h
// var GEOCENT_NO_ERROR  = 0x0000;
var GEOCENT_LAT_ERROR = 0x0001;
// var GEOCENT_LON_ERROR = 0x0002;
// var cs.a_ERROR        = 0x0004;
// var cs.b_ERROR        = 0x0008;
// var cs.a_LESS_B_ERROR = 0x0010;

// following constants from geocent.c
var COS_67P5  = 0.38268343236508977;  /* cosine of 67.5 degrees */
var AD_C      = 1.0026000;            /* Toms region 1 constant */

function cs_geodetic_to_geocentric (cs, p) {

/*
 * The function Convert_Geodetic_To_Geocentric converts geodetic coordinates
 * (latitude, longitude, and height) to geocentric coordinates (X, Y, Z),
 * according to the current ellipsoid parameters.
 *
 *    Latitude  : Geodetic latitude in radians                     (input)
 *    Longitude : Geodetic longitude in radians                    (input)
 *    Height    : Geodetic height, in meters                       (input)
 *    X         : Calculated Geocentric X coordinate, in meters    (output)
 *    Y         : Calculated Geocentric Y coordinate, in meters    (output)
 *    Z         : Calculated Geocentric Z coordinate, in meters    (output)
 *
 */

  var Longitude = p.x;
  var Latitude = p.y;
  var Height = p.z;
  var X;  // output
  var Y;
  var Z;

  var Error_Code=0;  //  GEOCENT_NO_ERROR;
  var Rn;            /*  Earth radius at location  */
  var Sin_Lat;       /*  Math.sin(Latitude)  */
  var Sin2_Lat;      /*  Square of Math.sin(Latitude)  */
  var Cos_Lat;       /*  Math.cos(Latitude)  */

  /*
  ** Don't blow up if Latitude is just a little out of the value
  ** range as it may just be a rounding issue.  Also removed longitude
  ** test, it should be wrapped by Math.cos() and Math.sin().  NFW for PROJ.4, Sep/2001.
  */
  if( Latitude < -HALF_PI && Latitude > -1.001 * HALF_PI )
      Latitude = -HALF_PI;
  else if( Latitude > HALF_PI && Latitude < 1.001 * HALF_PI )
      Latitude = HALF_PI;
  else if ((Latitude < -HALF_PI) || (Latitude > HALF_PI))
  { /* Latitude out of range */
    Error_Code |= GEOCENT_LAT_ERROR;
  }

  if (!Error_Code)
  { /* no errors */
    if (Longitude > PI)
      Longitude -= (2*PI);
    Sin_Lat = Math.sin(Latitude);
    Cos_Lat = Math.cos(Latitude);
    Sin2_Lat = Sin_Lat * Sin_Lat;
    Rn = cs.a / (Math.sqrt(1.0e0 - cs.es * Sin2_Lat));
    X = (Rn + Height) * Cos_Lat * Math.cos(Longitude);
    Y = (Rn + Height) * Cos_Lat * Math.sin(Longitude);
    Z = ((Rn * (1 - cs.es)) + Height) * Sin_Lat;

  }

  p.x = X;
  p.y = Y;
  p.z = Z;
  return Error_Code;
} // cs_geodetic_to_geocentric()


/** Convert_Geocentric_To_Geodetic
 * The method used here is derived from 'An Improved Algorithm for
 * Geocentric to Geodetic Coordinate Conversion', by Ralph Toms, Feb 1996
 */

function cs_geocentric_to_geodetic (cs, p) {

  var X =p.x;
  var Y = p.y;
  var Z = p.z;
  var Longitude;
  var Latitude;
  var Height;

  var W;        /* distance from Z axis */
  var W2;       /* square of distance from Z axis */
  var T0;       /* initial estimate of vertical component */
  var T1;       /* corrected estimate of vertical component */
  var S0;       /* initial estimate of horizontal component */
  var S1;       /* corrected estimate of horizontal component */
  var Sin_B0;   /* Math.sin(B0), B0 is estimate of Bowring aux variable */
  var Sin3_B0;  /* cube of Math.sin(B0) */
  var Cos_B0;   /* Math.cos(B0) */
  var Sin_p1;   /* Math.sin(phi1), phi1 is estimated latitude */
  var Cos_p1;   /* Math.cos(phi1) */
  var Rn;       /* Earth radius at location */
  var Sum;      /* numerator of Math.cos(phi1) */
  var At_Pole;  /* indicates location is in polar region */

  X = parseFloat(X);  // cast from string to float
  Y = parseFloat(Y);
  Z = parseFloat(Z);

  At_Pole = false;
  if (X != 0.0)
  {
      Longitude = Math.atan2(Y,X);
  }
  else
  {
      if (Y > 0)
      {
          Longitude = HALF_PI;
      }
      else if (Y < 0)
      {
          Longitude = -HALF_PI;
      }
      else
      {
          At_Pole = true;
          Longitude = 0.0;
          if (Z > 0.0)
          {  /* north pole */
              Latitude = HALF_PI;
          }
          else if (Z < 0.0)
          {  /* south pole */
              Latitude = -HALF_PI;
          }
          else
          {  /* center of earth */
              Latitude = HALF_PI;
              Height = -cs.b;
              return;
          }
      }
  }
  W2 = X*X + Y*Y;
  W = Math.sqrt(W2);
  T0 = Z * AD_C;
  S0 = Math.sqrt(T0 * T0 + W2);
  Sin_B0 = T0 / S0;
  Cos_B0 = W / S0;
  Sin3_B0 = Sin_B0 * Sin_B0 * Sin_B0;
  T1 = Z + cs.b * cs.ep2 * Sin3_B0;
  Sum = W - cs.a * cs.es * Cos_B0 * Cos_B0 * Cos_B0;
  S1 = Math.sqrt(T1*T1 + Sum * Sum);
  Sin_p1 = T1 / S1;
  Cos_p1 = Sum / S1;
  Rn = cs.a / Math.sqrt(1.0 - cs.es * Sin_p1 * Sin_p1);
  if (Cos_p1 >= COS_67P5)
  {
      Height = W / Cos_p1 - Rn;
  }
  else if (Cos_p1 <= -COS_67P5)
  {
      Height = W / -Cos_p1 - Rn;
  }
  else
  {
      Height = Z / Sin_p1 + Rn * (cs.es - 1.0);
  }
  if (At_Pole == false)
  {
      Latitude = Math.atan(Sin_p1 / Cos_p1);
  }

  p.x = Longitude;
  p.y =Latitude;
  p.z = Height;
  return 0;
} // cs_geocentric_to_geodetic()



/****************************************************************/
// pj_geocentic_to_wgs84(defn, p )
//    defn = coordinate system definition,
//  p = point to transform in geocentric coordinates (x,y,z)
function cs_geocentric_to_wgs84( defn, p ) {

  if( defn.datum_type == PJD_3PARAM )
  {
    // if( x[io] == HUGE_VAL )
    //    continue;
    p.x += defn.datum_params[0];
    p.y += defn.datum_params[1];
    p.z += defn.datum_params[2];

  }
  else  // if( defn.datum_type == PJD_7PARAM )
  {
    var Dx_BF =defn.datum_params[0];
    var Dy_BF =defn.datum_params[1];
    var Dz_BF =defn.datum_params[2];
    var Rx_BF =defn.datum_params[3];
    var Ry_BF =defn.datum_params[4];
    var Rz_BF =defn.datum_params[5];
    var M_BF  =defn.datum_params[6];
    // if( x[io] == HUGE_VAL )
    //    continue;
    var x_out = M_BF*(       p.x - Rz_BF*p.y + Ry_BF*p.z) + Dx_BF;
    var y_out = M_BF*( Rz_BF*p.x +       p.y - Rx_BF*p.z) + Dy_BF;
    var z_out = M_BF*(-Ry_BF*p.x + Rx_BF*p.y +       p.z) + Dz_BF;
    p.x = x_out;
    p.y = y_out;
    p.z = z_out;
  }
} // cs_geocentric_to_wgs84

/****************************************************************/
// pj_geocentic_from_wgs84()
//  coordinate system definition,
//  point to transform in geocentric coordinates (x,y,z)
function cs_geocentric_from_wgs84( defn, p ) {

  if( defn.datum_type == PJD_3PARAM )
  {
    //if( x[io] == HUGE_VAL )
    //    continue;
    p.x -= defn.datum_params[0];
    p.y -= defn.datum_params[1];
    p.z -= defn.datum_params[2];

  }
  else // if( defn.datum_type == PJD_7PARAM )
  {
    var Dx_BF =defn.datum_params[0];
    var Dy_BF =defn.datum_params[1];
    var Dz_BF =defn.datum_params[2];
    var Rx_BF =defn.datum_params[3];
    var Ry_BF =defn.datum_params[4];
    var Rz_BF =defn.datum_params[5];
    var M_BF  =defn.datum_params[6];
    var x_tmp = (p.x - Dx_BF) / M_BF;
    var y_tmp = (p.y - Dy_BF) / M_BF;
    var z_tmp = (p.z - Dz_BF) / M_BF;
    //if( x[io] == HUGE_VAL )
    //    continue;

    p.x =        x_tmp + Rz_BF*y_tmp - Ry_BF*z_tmp;
    p.y = -Rz_BF*x_tmp +       y_tmp + Rx_BF*z_tmp;
    p.z =  Ry_BF*x_tmp - Rx_BF*y_tmp +       z_tmp;
  }
} //cs_geocentric_from_wgs84()
//#####################################################################################################



//#####################################################################################################
/**
  GOOGLE_WGS84 & TM128_katech_3param

*/

// August 22, 2006
// Author: aero

csList.GOOGLE_WGS84 = "+title=GOOGLE MAP&EARTH / WGS84 +proj=longlat +a=6378137.0 +b=6356752.3146581478 +datum=WGS84";

// August 22, 2006
// Author: aero 

csList.TM128_katech_3param = "\
   +title=TM128_katech (3 param datum shift) \
   +proj=tmerc \
   +lat_0=38.0 +lon_0=128.0 \
   +x_0=400000.0 +y_0=600000.0 +k=0.9999 \
   +a=6377397.155 +b=6356078.9633422494 \
   +towgs84=-146.43,507.89,681.46,0,0,0,0 \
";
//+towgs84=-146.43,507.89,681.46,0,0,0,0       // Korean Official 3 param
//+towgs84=-147,506,687,0,0,0,0 \              // Tokyo Datum 1918
//+towgs84=-105.627,462.37,643.258,0,0,0,0 \   // GPS Korea
//+towgs84=-128,481,664,0,0,0,0 \              // NGMap

// August 22, 2006
// Author: aero 

csList.TM128_katech_7param = "\
   +title=TM128_katech (7 param datum shift) \
   +proj=tmerc \
   +lat_0=38.0 +lon_0=128.0 \
   +x_0=400000.0 +y_0=600000.0 +k=1.0 \
   +a=6377397.155 +b=6356078.9633422494 \
   +towgs84=-145.90,505.03,685.75,-1.162,2.347,1.592,6.342 \
";

// October 24, 2006
// Author: aero 

csList.KOREA_CENTER_TM_3param = "\
   +title=KOREA_CENTER_TM_3param (3 param datum shift) \
   +proj=tmerc \
   +lat_0=38.0 +lon_0=+lon_0=127.0028902777777777776 \
   +x_0=200000.0 +y_0=500000.0 +k=1.0 \
   +a=6377397.155 +b=6356078.9633422494 \
   +towgs84=-146.43,507.89,681.46,0,0,0,0 \
";
//+towgs84=-146.43,507.89,681.46,0,0,0,0       // Korean Official 3 param
//+towgs84=-147,506,687,0,0,0,0 \              // Tokyo Datum 1918
//+towgs84=-105.627,462.37,643.258,0,0,0,0 \   // GPS Korea
//+towgs84=-128,481,664,0,0,0,0 \              // NGMap

csList.EPSG102757 = "\
  +title=NAD 1983 StatePlane Wyoming West Central FIPS 4903 Feet\
  +proj=tmerc \
  +lat_0=40.5 +lon_0=-108.75 \
  +x_0=600000.0 +y_0=0 +k=0.999938 \
  +a=6378137.0  +b=6356752.3141403\
  +to_meter=0.3048006096012192 \
";

csList.EPSG102758 = "\
  +title=NAD 1983 StatePlane Wyoming West FIPS 4904 Feet\
  +proj=tmerc \
  +lat_0=40.5  +lon_0=-110.0833333333333 \
  +x_0=800000  +y_0=100000  +k=0.999938 \
  +a=6378137.0 +b=6356752.3141403\
  +to_meter=0.3048006096012192 \
";

// # Monte Mario (Rome) / Italy zone 1
// <26591> +proj=tmerc +lat_0=0 +lon_0=-3.45233333333333 +k=0.999600 +x_0=1500000 +y_0=0 +ellps=intl +pm=rome +units=m +no_defs  <>
// "intl",    "a=6378388.0", "rf=297.", "International 1909 (Hayford)"
// Rome   12d27'8.4E == 12.45233333333333

/*
csList.EPSG26591 = "+title= Monte Mario (Rome) / Italy zone 1 EPSG:26591\
+proj=tmerc\
+lat_0=0 +lon_0=-3.45233333333333 +from_greenwich=12.45233333333333\
+k=0.999600 +x_0=1500000 +y_0=0\
+a=6378388.0, +b=6356911.94612795";
*/

csList.EPSG26591 = "+title= Monte Mario (Rome) / Italy zone 1 EPSG:26591\
+proj=tmerc\
+lat_0=0 +lon_0=9 \
+k=0.999600 +x_0=1500000 +y_0=0\
+a=6378388.0, +b=6356911.94612795";

/*
Radim Blazek  Feb 1, 2006
I used

cs2cs -f %.5f +proj=tmerc +ellps=intl +lat_0=0 +lon_0=9 \
               +k=0.999600 +x_0=1500000 +y_0=0 \
               +no_defs  \
               +to +proj=latlong +datum=WGS84 \
               +no_defs
*/

csList.EPSG26912 = "+title=NAD83 / UTM zone 12N +proj=utm +zone=12 +a=6378137.0 +b=6356752.3141403";

// +proj=longlat +ellps=clrk66 +towgs84=11,72,-101,0,0,0,0 +no_defs  <>

csList.EPSG4139 = "\
  +title=Puerto Rico EPSG:4139 (3 param datum shift)\
  +proj=longlat \
  +towgs84 = 11,72,-101,0,0,0,0 \
  +a=6378206.4 +b=6356583.8 \
";

//  +proj=longlat +a=6378293.63683822 +b=6356617.979337744 +towgs84=-61.702,284.488,472.052,0,0,0,0 +no_defs  <>

csList.EPSG4302 = "+title=Trinidad 1903 EPSG:4302 (7 param datum shift)\
  +proj=longlat +a=6378293.63683822 +b=6356617.979337744 +towgs84=-61.702,284.488,472.052,0,0,0,0";

// August 22, 2006
// Author: aero 

csList.UTM_K = "\
   +title=UTM_K \
   +proj=tmerc \
   +datum=WGS84 \
   +lat_0=38.0 +lon_0=127.5 \
   +x_0=1000000.0 +y_0=2000000.0 +k=0.9996 \
   +a=6378137.0 +b=6356752.3141403 \
";
//#####################################################################################################
