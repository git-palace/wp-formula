(function ($) {
  $(".formula-view-container .questions").slick({
    arrows: false,
    draggable: false,
    infinite: false,
  });

  $(".formula-view-container .questions").show();

  var toNextQuestion = function () {
    setTimeout(function () {
      $(".formula-view-container .questions").slick('slickNext');
    }, 300);
  }

  $(".formula-view-container .question-item.single .card").click(function () {
    var cur_q_tag = $(this).parents(".question-item")[0];

    $(cur_q_tag).find(".active").removeClass("active");
    $(this).addClass("active");

    var question_idx = $(cur_q_tag).attr("question-idx");

    var formula_container = $(this).parents(".formula-view-container")[0];

    $(formula_container).find(".progress-bar").width((question_idx / question_cnt * 100) + '%');

    toNextQuestion();
  });


  $(".formula-view-container .question-item.multiple .card").click(function () {
    var cur_q_tag = $(this).parents(".question-item")[0];

    if ( $(this).hasClass("dontknow") ) {
      $(cur_q_tag).find(".active").removeClass("active");
      $(this).addClass("active");
    } else {
      $(cur_q_tag).find(".dontknow").removeClass("active");

      if ($(this).hasClass("active"))
        $(this).removeClass("active");
      else
        $(this).addClass("active");
    }

    if ($(cur_q_tag).find(".active").length)
      $(cur_q_tag).find("button").prop("disabled", false);
    else
      $(cur_q_tag).find("button").prop("disabled", true);
  });

  $(".formula-view-container .question-item.multiple button, .formula-view-container .question-item.slider button").click(function () {
    var question_idx = $($(this).parents(".question-item")[0]).attr("question-idx");

    var formula_container = $(this).parents(".formula-view-container")[0];

    $(formula_container).find(".progress-bar").width((question_idx / question_cnt * 100) + '%');

    toNextQuestion();
  });
})(jQuery);