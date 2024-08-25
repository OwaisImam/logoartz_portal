/**
 * @license Copyright © 2013 Stuart Sillitoe <stuart@vericode.co.uk>
 * This work is mine, and yours. You can modify it as you wish.
 *
 * Stuart Sillitoe
 * stuartsillitoe.co.uk
 *
 */

CKEDITOR.plugins.add('strinsert',
{
	requires : ['richcombo'],
	init : function( editor )
	{
		//  array of strings to choose from that'll be inserted into the editor
		var strings = [];
		strings.push(['[Salutation]', 'Salutation', 'Salutation']);
		strings.push(['[CustomerFirstName]', 'Customer First Name', 'Customer First Name']);
		strings.push(['[CustomerLastName]', 'Customer Last Name', 'Customer Last Name']);
		strings.push(['[CustomerFullName]', 'Customer Full Name', 'Customer Full Name']);
		strings.push(['[CustomerEmail]', 'Customer Email', 'Customer Email']);
		strings.push(['[BookingRef]', 'Booking Ref. No', 'Booking Ref. No']);
		strings.push(['[BookingDate]', 'Booking Date', 'Booking Date']);
		strings.push(['[BookingTotalAmount]', 'Booking Total Amount', 'Booking Total Amount']);
		strings.push(['[StatusName]', 'Status Name', 'Status Name']);

		// add the menu to the editor
		editor.ui.addRichCombo('strinsert',
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