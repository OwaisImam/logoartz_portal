/**
 * @license Copyright © 2013 Stuart Sillitoe <stuart@vericode.co.uk>
 * This work is mine, and yours. You can modify it as you wish.
 *
 * Stuart Sillitoe
 * stuartsillitoe.co.uk
 *
 */

CKEDITOR.plugins.add('atol',
{
	requires : ['richcombo'],
	init : function( editor )
	{
		//  array of strings to choose from that'll be inserted into the editor
		var strings = [];
		strings.push(['[CustomerLeadName]', 'Customer Lead Name', 'Customer Lead Name']);
		strings.push(['[NoOfPassengers]', 'Number of Passengers', 'Number of Passengers']);
		strings.push(['[CompanyName]', 'Company Name', 'Company Name']);
		strings.push(['[EmailAddress]', 'Email Address', 'Email Address']);
		strings.push(['[Telephone1]', 'Telephone 1', 'Telephone 1']);
		strings.push(['[Telephone2]', 'Telephone 2', 'Telephone 2']);
		strings.push(['[ATOLNumber]', 'ATOL Number', 'ATOL Number']);
		strings.push(['[BookingReference]', 'Booking Reference', 'Booking Reference']);
		strings.push(['[WebSiteAddress]', 'Website Address', 'Website Address']);

		// add the menu to the editor
		editor.ui.addRichCombo('atol',
		{
			label: 'Insert Content',
			title: 'Insert Content',
			voiceLabel: 'Insert Content',
			className: 'cke_format',
			multiSelect:false,
			panel:
			{
				css: [ editor.config.contentsCss, CKEDITOR.skin.getPath('editor') ],
				voiceLabel: editor.lang.panelVoiceLabel
			},

			init: function()
			{
				this.startGroup( "Insert Content" );
				for (var i in strings)
				{
					this.add(strings[i][0], strings[i][1], strings[i][2]);
				}
			},

			onClick: function( value )
			{
				editor.focus();
				editor.fire( 'saveSnapshot' );
				editor.insertHtml(value);
				editor.fire( 'saveSnapshot' );
			}
		});
	}
});