jQuery(function ($) {
  $('.js-accordion').each(function (i, el) {
    const $this = $(el);
    const $title = $this.find('.js-accordion__title');
    const $content = $this.find('.js-accordion__content');
    $title.on('click', function () {
      $this.toggleClass('active');
      $content.slideToggle();
    });
  });
});
jQuery(function ($) {
  const observer = new IntersectionObserver(function (entries, observer) {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        entry.target.style.setProperty('--intersectDelay', index * 0.2 + 's');
        entry.target.classList.add('intersected');
      }
    });
  }, {
    threshold: 0.25
  });
  $('.intersect').each(function (i, el) {
    observer.observe(el);
  });
});
jQuery(function ($) {
  const $modals = $('.modal');
  $modals.each(function (i, el) {
    const $this = $(el);
    const id = $this.attr('id');
    const $buttons = $('a[href="#' + id + '"]');
    const $close = $this.find('.modal__close');
    const $body = $this.find('.modal__body');
    const $onOpen = $this.find('.modal__onOpen');
    $buttons.on('click', function (e) {
      e.preventDefault();
      openModal();
    });
    $close.on('click', closeModal);
    $this.on('click', closeModal);
    $body.on('click', function (e) {
      e.stopPropagation();
    });
    function openModal() {
      if ($onOpen.length) {
        $body.html($onOpen.html());
      }
      $this.fadeIn();
      $('body').addClass('modal-is-open');
    }
    function closeModal() {
      $this.fadeOut(200, function () {
        if ($onOpen.length) {
          $body.html('');
        }
      });
      $('body').removeClass('modal-is-open');
    }
  });
});
jQuery(function ($) {
  const $menu = $('.stickyHeader');
  let scrolling = false;
  const min_scroll_sticky = 300;
  let sticky_threshold = 0;
  let previous_scroll = window.scrollY;
  const $globalBanner = $('.topBar');
  $(window).on('scroll', function () {
    if (!scrolling) {
      scrolling = true;
      requestAnimationFrame(scroll);
    }
  });
  if ($globalBanner.length) {
    onResize();
    $(window).on('resize', onResize);
  }
  function scroll() {
    const current_scroll = window.scrollY;
    const scrolling_up = current_scroll - previous_scroll < 0;
    if (scrolling_up && current_scroll >= min_scroll_sticky) {
      $menu.addClass('sticky in');
      if ($('body').hasClass('is-front')) {
        $menu.addClass('barmenu--font');
      }
    } else if (!scrolling_up && current_scroll >= min_scroll_sticky) {
      $menu.removeClass('in');
      if ($('body').hasClass('is-front')) {
        $menu.removeClass('barmenu--font');
      }
    } else if (scrolling_up && current_scroll <= sticky_threshold) {
      $menu.removeClass('sticky');
      if ($('body').hasClass('is-front')) {
        $menu.removeClass('barmenu--font');
      }
    }
    previous_scroll = current_scroll;
    scrolling = false;
  }
  function onResize() {
    sticky_threshold = $globalBanner.outerHeight();
  }
});
jQuery(function ($) {
  $('.testimonials').each(function (i, el) {
    const $this = $(el);
    const $sliderSubContent = $this.find('.testimonials__slider');
    const $slides = $this.find('.testimonials__slide');
    if (!$slides.length) {
      return;
    }
    const $angleBrackets = $this.find('.testimonials__control');
    const $back = $angleBrackets.eq(0);
    const $next = $angleBrackets.eq(1);
    let currentIndex = 0;
    resizeContainer(true);
    $next.on('click', next);
    $back.on('click', back);

    // let interval = setInterval(next, 8000);

    $(window).on('resize', function () {
      resizeContainer(false);
    });
    $(window).on('load', function () {
      resizeContainer(true);
    });
    $sliderSubContent.addClass('active');
    function resizeContainer() {
      $sliderSubContent.height($slides.eq(currentIndex).outerHeight());
    }
    function goto(index) {
      $slides.eq(currentIndex).fadeOut();
      $slides.eq(index).fadeIn();
      currentIndex = index;
      resizeContainer();
      clearInterval(interval);
      interval = setInterval(next, 8000);
    }
    function next() {
      const index = (currentIndex + 1) % $slides.length;
      goto(index);
    }
    function back() {
      const index = (currentIndex - 1 + $slides.length) % $slides.length;
      goto(index);
    }
  });
});