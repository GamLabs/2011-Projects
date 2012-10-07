/**
 * Ajax Forms plugin for thickbox
 * 
 * @param {String} hook
 * @param {Object} args
 * @return {Bool}
 */
Drupal.Ajax.plugins.ppcustom_currency_form = function(hook, args) {
  if (hook === 'message') {
    // alert(args.data.options.result);
		$(document).ready(function(){
			$('#results').replaceWith('<div id="results">' + args.data.options.result + ' ' + args.data.options.to + '</div>');
		});
	}
}