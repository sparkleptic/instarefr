$(document).ready(function(){
	tinymce.init({
		selector:'#job-description-textarea, #company-description-textarea',
		plugins: "link",
		menubar: "insert",
		toolbar: [
			'bold | italic | bullist | numlist | link | unlink | undo | redo'
		],
		menubar: false,
		link_context_toolbar: true,
		min_height : 144,
	});
});