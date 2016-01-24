function displayDialogFeed(e) {
	var countrycode = $(this).attr('countrycode');
	var regioncode = $(this).attr('regioncode');
	var region = $(this).attr('region');
	var countryname = $(this).attr('countryname');
	var flagdescription = $(this).attr('flagdescription');
	var flagsubfield = $(this).attr('flagsubfield');						
	var flagdescriptionnote = $(this).attr('flagdescriptionnote');	
	var countryaffiliation = $(this).attr('countryaffiliation');
	var typeimage = $(this).attr('typeimage');
	var path = $(this).attr('path');	
	var folder = $(this).attr('folder');
	var regionname = $(this).attr('regionname');			
	var flagdialogHTML = '';
	var textclass = '';
	var textclass1 = '';
	var bgcolor = '';

	if (countryaffiliation == '')	{
		ht = 25;
		ht1 = 429;
	}
	else	{
		ht = 30;
		ht1 = 425;
	}
		
	if (typeimage == 'flag')	{
		image = '"../graphics/flags/large/' + countrycode.toLowerCase() + '-lgflag.gif" class="' + regioncode + '_lgflagborder fotw2"';
		texttitle = 'Flag Description';
		if (flagdescriptionnote == '')
		{description1 = flagdescription}   
		else
		{description1 = flagdescription + '<br><br><strong>note: </strong>'  + flagdescriptionnote;}
		flagdescriptionnote = flagdescriptionnote;
		display = "";
//		display1 = "display: none;";
		display1 = "";
		addClass = '';
		hrefprint = '"../print/flag/' + countrycode.toUpperCase() + '_flag.pdf"';
	}	
	else if (typeimage == 'population')	{
		texttitle = 'Population Pyramid';
		image = '"../graphics/population/' + countrycode.toUpperCase() + '_popgraph 2014.bmp" class="populationFit"';
		display = "";
		display1 = "display: none;";
		description1 = 'A population pyramid illustrates the age and sex structure of a country&#39;s population and may provide insights about political and social stability, as well as economic development.  The population is distributed along the horizontal axis, with males shown on the left and females on the right.  The male and female populations are broken down into 5-year age groups represented as horizontal bars along the vertical axis, with the youngest age groups at the bottom and the oldest at the top.  The shape of the population pyramid gradually evolves over time based on fertility, mortality, and international migration trends.<div style="height: 8px;">&nbsp;</div>For additional information, please see the entry for "Population pyramid" on the Definitions and Notes page under the References tab';
		addClass = '';
		hrefprint = '"../graphics/population/' + countrycode.toUpperCase() + '_popgraph 2014.bmp" target="blank"';
	}
			
	else if (typeimage == 'map')	{
		texttitle = '';
		display = "display: none;"
		image = '"../graphics/maps/' + countrycode.toLowerCase() + '-map.gif" ';
		display1 = "display: none;";					
		description1 = '';
		addClass = 'mapFit1';
		hrefprint = '"../graphics/maps/' + countrycode.toLowerCase() + '-map.gif" target= "blank"';
	}
	else if (typeimage == 'fertility')	{
		texttitle = 'Total Fertility Rate';
		display = "display: none;"
		image = '"../graphics/fertility/' + countrycode.toLowerCase() + '_fertility 2014.bmp" ';
		display = "";
		display1 = "display: none;";				
		description1 = '';
		addClass = 'mapFit1';
		hrefprint = '"../graphics/fertility/' + countrycode.toLowerCase() + '_fertility 2014.bmp" target= "blank"';
	}
	else if (typeimage == 'areacomparison')	{
		texttitle = 'Area Comparison';
		display = "display: none;"
		image = '"../graphics/areacomparison/' + countrycode.toLowerCase() + '_area 2014.bmp" ';
		display = "";
		display1 = "display: none;";				
		description1 = '';
		addClass = 'mapFit1';
		hrefprint = '"../graphics/areacomparison/' + countrycode.toLowerCase() + '_area 2014.bmp" target= "blank"';
	}
	else if (typeimage == 'refmaps')	{
		texttitle = '';
		region = 'References';
		countryname = 'Regional and World Maps';
		display = "display: none;"
		path= path;
		folder = folder;
		regionname = regionname;
		regioncode = 'refmaps';
		image = '"../graphics/ref_maps/' + folder + '/jpg/' + regionname + '.jpg" ';
		display = "display: none;";
		description1 = '';
		bgcolor = 'bgcolor="#FBFBEE"';
		textclass = 'region';
		textclass1 = 'region_name';
		display1 = "display: none;";
		addClass = '';
		hrefprint = '"../graphics/ref_maps/' + folder + '/pdf/' + regionname + '.pdf"';
	}

	else if (typeimage == 'locator')	{
		texttitle = '';
		display = "display: none;";
		image = '"../graphics/locator/' + regioncode + '/' + countrycode.toLowerCase() + '_large_locator.gif" ';
		description1 = '';
		display1 = "display: none;";
		addClass = '';		
		hrefprint = '"../graphics/locator/' + regioncode + '/' + countrycode.toLowerCase() + '_large_locator.gif" ';
	}

	else	{
		texttitle = '';
		display = "display: none;";	
		textclass = 'region1';
		textclass1 = 'region_name1';
		addClass = '';		
		display1 = "display: none;";
	}
			
			
	flagdialogHTML =	'		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(../graphics/' + regioncode + '_lgmap_bkgrnd.jpg)" >';
	flagdialogHTML += 	'			<tr class="' + regioncode +  '_dark">';
	flagdialogHTML +=   '				<td height="'+ ht + '" valign="middle" style="padding-top: 4px;"><div class="' +  textclass + '">&nbsp;&nbsp;' + region + '<strong> :: </strong><span class="' +  textclass1 + '">' +  countryname + '</span></div>';
	flagdialogHTML +=   '					<div class="affiliation" style="' + display1 + '"><em>&nbsp;&nbsp;' + countryaffiliation + '</em></div>';
	flagdialogHTML +-   '				</td>';
	flagdialogHTML +=   '				<td align="right">';
	flagdialogHTML +=   '					<table width="35" border="0" cellspacing="0" cellpadding="0">';
	flagdialogHTML +=   '						<tr>';
	flagdialogHTML +=   '							<td width="25" align="right"><a href=' + hrefprint + ' target="_blank"><img src="../graphics/print.gif" alt="Print Page" title="Print Page" width="23" height="18" border="0" style="padding-right: 10px;"></a></td>';
	//flagdialogHTML +=   '							<td width="25" align="right"><a href=' + hrefprint + ' target="_blank"></a></td>';
	flagdialogHTML +=   '						</tr>';
	flagdialogHTML +=   '					</table>';
	flagdialogHTML +=   '				</td>';
	flagdialogHTML +=   '			</tr>';
	flagdialogHTML +=   '			<tr>';
	flagdialogHTML +=   '				<td colspan="2" height="3" bgcolor="#d6d6d6"></td>';
	flagdialogHTML +=   '			</tr>';
	flagdialogHTML +=   '			<tr>';
	flagdialogHTML +=   '				<td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" >';
	flagdialogHTML +=   '			<tr>';
	flagdialogHTML +=   '				<td height="'+ ht1 + '" align="center" valign="middle" style="padding: 10px;"' + bgcolor + '"><img src=' + image + 'class="' + regioncode + '_lgflagborder ' + addClass + '"/>'; 
	flagdialogHTML +=   '				</td>';
	flagdialogHTML +=   '			<td width="265" valign="middle" id="flag_caption" style="' + display + '">';
	flagdialogHTML +=   '				<table width="238" border="0" cellpadding="0" cellspacing="0" style="margin: 1px;">';
	flagdialogHTML +=   '					<tr>';
	flagdialogHTML +=   '						<td height="20" class="' + regioncode + '_medium" style="font-size:10px; padding-left:5px; font-weight:bold; border:1px solid #FFFFFF;">' + texttitle ;
	flagdialogHTML +=   '						</td>';
	flagdialogHTML +=   '					</tr>';
	flagdialogHTML +=   '					<tr>';
	flagdialogHTML +=   '							<td valign="top">';
	flagdialogHTML +=   '								<div class="photogallery_captiontext" style="height: 375px;background-color:white;">';
	flagdialogHTML +=   '									<span class="flag_description_text">';
	flagdialogHTML +=   										 description1 + "" ;											
	flagdialogHTML +=   '									</span>';
	flagdialogHTML +=   '								</div>';
	flagdialogHTML +=   '							</td>';
	flagdialogHTML +=   '						</tr>';
	flagdialogHTML +=   '					</table>';
	flagdialogHTML +=   ' 				</td>';


	flagdialogHTML +=   '			</tr>';
	flagdialogHTML +=   '	</table>';
	flagdialogHTML +=   ' </td>';
	flagdialogHTML +=   ' </tr>';
	flagdialogHTML +=   ' <tr class="' + regioncode + '_dark">';
	flagdialogHTML +=   ' 	<td height="2"  colspan="2"></td>';
	flagdialogHTML +=   ' </tr>';
	flagdialogHTML +=   ' <tr class="' + regioncode +  '_medium">';
	flagdialogHTML +=   ' 	<td height="15" align="right" valign="top" colspan="2">';
	//flagdialogHTML +=   ' 		<br />';
	flagdialogHTML +=   '	</td>';
	flagdialogHTML +=   ' </tr>';
	flagdialogHTML +=   '	</table>';
	$('#flagDialog').html(flagdialogHTML);
	$('#flagDialog').dialog( "open" );

	return false;
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

// Cookie management **************************************************************************************************************************************************************************************************************************
function createCookie(name, value, days)	{
	var expires
	if (days)	{
		var date = new Date();
		date.setTime(date.getTime() + (days * 23 * 60 * 60 * 1000));
		expires = "; expires=" + date.toGMTString();
	} else expires = "";
	document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

function readCookie(name)	{
	var nameEQ = escape(name) + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++)	{
		var c = ca[i];
		while (c.charAt(0) == ' ') 
			c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0)
			return unescape(c.substring(nameEQ.length, c.length));
	}
	
	return null;
}

function eraseCookie(name)	{
	createCookie(name, "", -1);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//this is for EXPAND / COLLAPSE ALL ON ALL PAGES THAT USE IT
$( function() {
		var cookiecc, cookiesection;
		
		cookiecc = readCookie("country");
		cookiesecion = readCookie("section");
		
		$('#countryInfo').show();
		$('#flagBox').show();
		$('#mapBox').show();
		$('#locatorBox').show();
//		$('[id^="flagDialog2_"]').fadeIn(1000);
//		$('[id^="mapDialog2_"]').fadeIn(1000);
//		$('[id^="locatorDialog2_"]').fadeIn(1000);
		$('[id^="flagDialog2_"]').show();
		$('[id^="mapDialog2_"]').show();
		$('[id^="locatorDialog2_"]').show();

		$('.expand').click(	function() {
								$('.collapse').show( );
								$('.expand').hide();
							}
						);
		
		$('.collapse').click(	function() {
									$('.expand').show();
									$('.collapse').hide();
								}
							);

		$('.question').click(	function()	{
									var cc="", seclabel="";
									for (var i = 0; i < this.attributes.length; i++)	{
										if (this.attributes[i].name == 'sectiontitle') {
											seclabel = this.attributes[i].value;
										}
										if (this.attributes[i].name == 'ccode') {
											cc = this.attributes[i].value;
										}
									}

									if (cc != readCookie("country")) {
										createCookie("country", cc);
									}
									createCookie("section", seclabel);
									
									
									if	($(this).next().is(':hidden') != true) {
										$(this).removeClass('active');
										$(this).next().slideUp("normal");
									}
									else {
										$('.question').removeClass('active');
										$('.answer').slideUp('normal');
										if ($(this).next().is(':hidden') == true) {
											$(this).addClass('active');
											$(this).next().slideDown('normal');
										}
									}
								}
							);

		$('.answer').hide();

		$('.expand').click(	function(event)	{
								$('.question').next().slideDown('normal');
								{
									$('.question').addClass('active');
								}
							}
						);

		$('.collapse').click(	function(event)	{
									$('.question').next().slideUp('normal');
									{
										$('.question').removeClass('active');
									}
								});



		// Select all elements that are to share the same tooltip
		$('a[title]').qtip(
							{
								position: {
									target: 'mouse',
									my: 'bottom center',
									viewport: $(window),
									adjust: { x:10 , y: -10 }
								},
								hide: { fixed: true },
								style: 'light'
							});
											



		$('[id^="GetAppendix_"]').listnav(
											{
												initLetter:'a',	
												showCounts: false,
												includeAll: true,
												includeNums: false,
												includeOther: false,
												onClick:	function(letter) {
																$("#alpha").html(letter.toUpperCase());
															}
											});
		//this is for ALPHABETICAL QUICK LINKS ALL ON FLAGS OF THE WORLD
		$('#GetFlagsoftheWorld').listnav(
											{	initLetter:'a',	
												showCounts: false,
												includeAll: true,
												includeNums: false,
												includeOther: false
											}
										);

		//this is for RESIZING OF FLAGS ON FLAGS OF THE WORLD AND COUNTRY PAGES
		$('img.structure').resize (	{
										scale: 0.5,
										maxWidth: 150,
										maxHeight:130
									});
	
		$('img.flagFit').resize (	{
										scale: .60,
										maxWidth: 110,
										maxHeight: 110
									});
	
		$('img.flagFit2').resize (	{
										//scale: 0.75,
										maxWidth: 300,
										maxHeight:300
									});
	
		$('img.fotw').resize (	{
									scale: 1,
									maxWidth: 100,
									maxHeight: 90
								});
	
		$('img.fotw2').resize (	{
									scale: 0.5,
									maxWidth: 400,
									maxHeight:300
								});

		$('img.mapFit').resize ({
									scale: 1,
									maxWidth: 290,
									maxHeight:290
								});
		$('img.mapFit1').resize ({
									scale: 1,
									maxWidth: 600,
									maxHeight:600
								});	
		$('img.populationFit').resize ({
											scale: 1
											//maxWidth: 300,
											//maxHeight:300
										});
	
		$('img.locatorFit').resize ({
										scale: .20//,
								//		maxWidth: 175,
								//		maxHeight:175
									});
		
		$('img.locatorFit2').resize ({
										scale: .60//,
								//		maxWidth: 175,
								//		maxHeight:175
									});	
									
									
									
									
		// dialog window for gallery of covers //


		


		//flags of the world ///		
		$( "#flagDialog").dialog({
				autoOpen: false,
				draggable: false,
				closeText: "",
				width: 950,
				mineight: 600,
				modal: true,
				resizable: false,
				show: "blind",
				hide: "blind",
				position: "top"
			});

		$('[id^="flagDialog2_"]').click(displayDialogFeed);
		$('[id^="flagDialog2a_"]').click(displayDialogFeed);
		$('[id^="mapDialog2_"]').click(displayDialogFeed);	
		$('[id^="locatorDialog2_"]').click(displayDialogFeed);			
		$('[id^="refmapDialog_"]').click(displayDialogFeed);	
		
		$('.galleryDialog').click(function() {
			var year = $(this).attr('year');
			$('#galleryDialogWindow').dialog( "open" );	
			$( "#galleryDialogWindow" ).load('gallerycovers_template_' + year + '.html');
		});
	
		$( "#galleryDialogWindow" ).dialog({
				autoOpen: false,
				draggable: false,
				closeText: "",
				//width: $(window).width()-180,
				//height: $(window).height()-180,
				height: 700,
				width: 1000,
				modal: true,
				resizable: false,
				show: "blind",
				hide: "blind",
				position: "top"
			});

			$('img.galleryFit').resize ({
				scale: 1
				//maxWidth: 590,
				//maxHeight:590
			});

		$( "#photoDialogWindow" ).dialog({
									autoOpen: false,
									draggable: false,
									closeText: "",
									//width: $(window).width()-180,
									//height: $(window).height()-180,
									height: 700,
									width: 1000,
									modal: true,
									resizable: false,
									show: "blind",
									hide: "blind",
									position: "top"
								});
								
		// Photo Gallery on country Page  //	
		$('.photoDialog, #photoDialog').on("click",	function()	{
											var countrycode = $(this).attr('countrycode');
											var regioncode = $(this).attr('regioncode');
											var region = $(this).attr('region');
											var countryname = $(this).attr('countryname');
											var theURL = 'wfb_photo_gallery/' + countrycode + '_photogallery.html';
											$( "#photoDialogWindow" ).load(theURL,	function() {	
											Galleria.loadTheme('wfb_photo_gallery/galleria.classic.js');

// Initialize Galleria
Galleria.run('#galleria');

																																		
																																			$( "#photoDialogWindow" ).dialog( "open");
																																			$('.content-header').html(region + ' :: ' + '&nbsp;' + countryname);
																																			$('.content-header').addClass(regioncode + '_dark');
																																			$('.content-header').css('padding','3px');
																																			$('.content-header').css('font-weight','bold');
																																		}
																		);
											return false;
										});
});		
	
