<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="admin">
    <div class="row">
        <div class="container">
            <div class="col-md-12 mx-auto mt-60">
                <article class="page-edit">
                    <a href="<?php echo URLROOT; ?>/admin/edit/<?php echo $data['id']; ?>" class="btn btn-light"><i class="fas fa-angle-left"></i> กลับ</a>
                    <div class="mt-5">
                        <h2>แก้ไขการแข่งขัน</h2>
                        <form action="<?php echo URLROOT; ?>/admin/edit/<?php echo $data['id']; ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" disabled>
                            <div class="form-group">
                                <label for="title"> Title: </label>
                                <input type="text" name="title" class="form-control form-control-lg <?echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="slug"> Slug: </label>
                                <input type="text" name="slug" class="form-control form-control-lg <?echo (!empty($data['slug_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['slug']; ?>">
                                <span class="invalid-feedback"><?php echo $data['slug_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="content"> Short Description: </label>
                                <textarea name="short_description" class="form-control form-control-lg <?echo (!empty($data['short_description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['short_description']; ?></textarea>
                                <span class="invalid-feedback"><?php echo $data['short_description_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="content"> Full Description: </label>
                                <textarea name="full_description" class="editor allow-tabs form-control form-control-lg <?echo (!empty($data['full_description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['full_description']; ?></textarea>
                                <span class="invalid-feedback"><?php echo $data['full_description_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="slug"> Logo filename: </label>
                                <input type="text" name="logo_src" class="form-control form-control-lg <?echo (!empty($data['logo_src_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['logo_src']; ?>">
                                <span class="invalid-feedback"><?php echo $data['logo_src_err']; ?></span>
                            </div>
                            <div class="row">
                                <input type="submit" class="btn login-btn" value="แก้ไขการแข่งขัน">
                            </div>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<script>
var tabCharacter = "  ";
var tabOffset = 2;

$(document).on('click', '#indent', function(e){
	e.preventDefault();
	var self = $(this);
	
	self.toggleClass('active');
	
	if(self.hasClass('active'))
	{
		tabCharacter = "\t";
		tabOffset = 1;
	}
	else
	{
		tabCharacter = "  ";
		tabOffset = 2;
	}
})

$(document).on('click', '#fullscreen', function(e){
	e.preventDefault();
	var self = $(this);
	
	self.toggleClass('active');
	self.parents('.editor-holder').toggleClass('fullscreen');
});

/*------------------------------------------
	Render existing code
------------------------------------------*/
$(document).on('ready', function(){
	hightlightSyntax();
	
	emmet.require('textarea').setup({
    pretty_break: true,
    use_tab: true
	});
});




/*------------------------------------------
	Capture text updates
------------------------------------------*/
$(document).on('ready load keyup keydown change', '.editor', function(){
	correctTextareaHight(this);
	hightlightSyntax();
});


/*------------------------------------------
	Resize textarea based on content  
------------------------------------------*/
function correctTextareaHight(element)
{
  var self = $(element),
      outerHeight = self.outerHeight(),
      innerHeight = self.prop('scrollHeight'),
      borderTop = parseFloat(self.css("borderTopWidth")),
      borderBottom = parseFloat(self.css("borderBottomWidth")),
      combinedScrollHeight = innerHeight + borderTop + borderBottom;
  
  if(outerHeight < combinedScrollHeight )
  {
    self.height(combinedScrollHeight);
  }
}
// function correctTextareaHight(element){
// 	while($(element).outerHeight() < element.scrollHeight + parseFloat($(element).css("borderTopWidth")) + parseFloat($(element).css("borderBottomWidth"))) {
// 		$(element).height($(element).height()+1);
// 	};
// }


/*------------------------------------------
	Run syntax hightlighter  
------------------------------------------*/
function hightlightSyntax(){
	var me  = $('.editor');
	var content = me.val();
	var codeHolder = $('code');
	var escaped = escapeHtml(content);
	
	codeHolder.html(escaped);
	
	$('.syntax-highight').each(function(i, block) {
		hljs.highlightBlock(block);
	});
}


/*------------------------------------------
	String html characters
------------------------------------------*/
function escapeHtml(unsafe) {
	return unsafe
			 .replace(/&/g, "&amp;")
			 .replace(/</g, "&lt;")
			 .replace(/>/g, "&gt;")
			 .replace(/"/g, "&quot;")
			 .replace(/'/g, "&#039;");
}


/*------------------------------------------
	Enable tabs in textarea
------------------------------------------*/
$(document).delegate('.allow-tabs', 'keydown', function(e) {
	var keyCode = e.keyCode || e.which;

	if (keyCode == 9) {
		e.preventDefault();
		var start = $(this).get(0).selectionStart;
		var end = $(this).get(0).selectionEnd;

		// set textarea value to: text before caret + tab + text after caret
		$(this).val($(this).val().substring(0, start)
								+ tabCharacter
								+ $(this).val().substring(end));

		// put caret at right position again
		$(this).get(0).selectionStart =
		$(this).get(0).selectionEnd = start + tabOffset;
	}
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
