(function ($) {
  $(".formula-view-container .questions").slick({
    arrows: false,
    draggable: false,
    infinite: false,
    adaptiveHeight: true
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

    if ($(this).hasClass("dontknow")) {
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

  $(".formula-view-container .question-item.last-question input").keydown(function (e) {
    if (e.keyCode == 8 || e.keyCode == 46)
      return true;

    if ($(this).val().length >= 4)
      return false;

    return /^\d/.test(e.key);
  }).change(function () {
    var cur_q_tag = $(this).parents(".question-item")[0];

    if (/^\d{4}$/.test($(this).val())) {
      $(this).removeClass("invalid");
      $(cur_q_tag).find("button").prop("disabled", false);
    } else {
      $(this).addClass("invalid");
      $(cur_q_tag).find("button").prop("disabled", true);
    }
  });

  $(".formula-view-container .question-item.last-question button").click(function () {
    $(".formula-view-container .progress").hide();

    toNextQuestion();

    var interval = setInterval(function () {
      if ($(".formula-view-container .question-item.loading-screen").hasClass("slick-active") && $(".formula-view-container .question-item.loading-screen").hasClass("slick-current")) {
        setTimeout(function () {
          toNextQuestion();
        }, 1000);

        clearInterval(interval);
      }
    }, 500);
  });

  $(".formula-view-container .question-item.submit-screen .inc-tooltip a").click(function () {
    if ($(this).siblings().eq(0).hasClass("opened"))
      $(this).siblings().eq(0).removeClass("opened");
    else {
      $(".formula-view-container .question-item.submit-screen .inc-tooltip .description.opened").removeClass("opened");
      $(this).siblings().eq(0).addClass("opened");
    }
  });
})(jQuery);

(function () {
  'use strict';
  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})(jQuery);