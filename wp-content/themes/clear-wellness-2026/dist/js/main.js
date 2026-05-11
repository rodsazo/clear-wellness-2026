jQuery(function ($) {
  $('.js-accordion-wrap').each(function (i, el) {
    const $wrap = $(el);
    const $accordions = $wrap.find('.js-accordion');
    const $contents = $wrap.find('.js-accordion__content');
    $accordions.each(function (i, el) {
      const $this = $(el);
      const $trigger = $this.find('.js-accordion__title');
      const $content = $this.find('.js-accordion__content');
      $trigger.on('click', function () {
        const isOpen = $this.hasClass('active');
        if (!isOpen) {
          $accordions.removeClass('active');
          $accordions.find('.js-accordion__title').attr('aria-expanded', 'false');
          $contents.slideUp();
        }
        $this.toggleClass('active');
        $trigger.attr('aria-expanded', $this.hasClass('active') ? 'true' : 'false');
        $content.stop().slideToggle();
      });
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
  const $btn = $('.siteHeader__mobBtn');
  const $menu = $('.siteHeader__mobMenu');
  const $body = $('body');
  $btn.on('click', function () {
    const isOpen = $btn.hasClass('is-open');
    if (isOpen) {
      close();
    } else {
      open();
    }
  });

  // Close on any link click inside the mobile menu
  $menu.on('click', 'a', function () {
    close();
  });
  function open() {
    $btn.addClass('is-open').attr('aria-expanded', 'true');
    $menu.addClass('is-open').attr('aria-hidden', 'false');
    $body.css('overflow', 'hidden');
  }
  function close() {
    $btn.removeClass('is-open').attr('aria-expanded', 'false');
    $menu.removeClass('is-open').attr('aria-hidden', 'true');
    $body.css('overflow', '');
  }
});
jQuery(function ($) {
  const FOCUSABLE = 'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';
  const $modals = $('.modal');
  $modals.each(function (i, el) {
    const $modal = $(el);
    const id = $modal.attr('id');
    const $triggers = $('[href="#' + id + '"], [data-modal="' + id + '"]');
    const $close = $modal.find('.modal__close');
    const $body = $modal.find('.modal__body');
    const $onOpen = $modal.find('.modal__onOpen');
    let $lastFocus = null;
    $triggers.on('click', function (e) {
      e.preventDefault();
      openModal($(this));
    });
    $close.on('click', closeModal);
    $modal.on('click', function (e) {
      if (!$(e.target).closest('.modal__content').length) {
        closeModal();
      }
    });
    $modal.on('keydown', function (e) {
      if (e.key === 'Escape') {
        closeModal();
        return;
      }
      if (e.key === 'Tab') {
        trapFocus(e);
      }
    });
    function trapFocus(e) {
      const $focusable = $modal.find(FOCUSABLE).filter(':visible');
      const first = $focusable[0];
      const last = $focusable[$focusable.length - 1];
      if (e.shiftKey) {
        if (document.activeElement === first) {
          e.preventDefault();
          last.focus();
        }
      } else {
        if (document.activeElement === last) {
          e.preventDefault();
          first.focus();
        }
      }
    }
    function openModal($trigger) {
      if ($onOpen.length) {
        $body.html($onOpen.html());
      }
      $lastFocus = $trigger || null;
      $modal.fadeIn(200, function () {
        $modal.removeAttr('aria-hidden');
        const $first = $modal.find(FOCUSABLE).filter(':visible').first();
        if ($first.length) {
          $first.trigger('focus');
        } else {
          $modal.attr('tabindex', '-1').trigger('focus');
        }
      });
      $('body').addClass('modal-is-open');
    }
    function closeModal() {
      $modal.attr('aria-hidden', 'true');
      $modal.fadeOut(200, function () {
        if ($onOpen.length) {
          $body.html('');
        }
      });
      $('body').removeClass('modal-is-open');
      if ($lastFocus) {
        $lastFocus.trigger('focus');
        $lastFocus = null;
      }
    }
  });
});
jQuery(function ($) {
  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('intersected');
      }
    });
  }, {
    threshold: 0.25
  });
  $(document).on('click', '.js-newsLoadMore', function () {
    const $btn = $(this);
    const page = parseInt($btn.data('page')) + 1;
    const exclude = $btn.data('exclude') || 0;
    const categories = $btn.data('categories') || '';
    const nonce = $btn.data('nonce');
    const $grid = $btn.closest('.newsList__list').find('.newsList__grid');
    $btn.prop('disabled', true).text('Loading…');
    $.post(themeData.ajaxUrl, {
      action: 'news_load_more',
      page: page,
      exclude: exclude,
      categories: categories,
      nonce: nonce
    }, function (response) {
      if (!response.success) return;
      const $cards = $(response.data.html);
      $grid.append($cards);
      $cards.filter('.intersect').each(function (i, el) {
        observer.observe(el);
      });
      $btn.data('page', page).prop('disabled', false).text('Load more');
      if (!response.data.has_more) {
        $btn.closest('.newsList__loadMore').remove();
      }
    });
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