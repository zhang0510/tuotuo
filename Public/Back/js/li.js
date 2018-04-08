
	$(function(){
		$('dl.dl1 dd:last,dl.dl2 dd:last,dl.dl3 dd:last,dl.dl4 dd:last,dl.dl5 dd:last,dl.dl6 dd:last,dl.dl7 dd:last,dl.dl8 dd:last').css('background','url(img/l_t1.jpg) no-repeat');
	});
	
	  

   $(".selected0 li").click(function(){
	  $(this).parent().parent().hide();
	   var oop= $(this).html();
	  $(this).parent().parent().siblings('.inko').val(oop);

	  });
	      $(".inko").click(function(){
	  $(this).siblings(".selected").show();
	  //$(this).siblings(".selected0").show();

	  });
	   function ceshi3(obj){
	    	$(obj).siblings(".selected0").show();
	    }
    $('.bg').click(function(){

    	$('.modal-backdrop').click();
		  $('.bg').hide();
   $('.tan1').hide();
    });

    $('.closed').click(function(){

    	$('.modal-backdrop').click();
		  $('.bg').hide();
$('.tan1').hide();
    });