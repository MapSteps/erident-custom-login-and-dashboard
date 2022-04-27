/**
 * This script is intended to handle the settings page.
 *
 * @param {Object} $ jQuery object.
 * @return {Object}
 */
(function ($) {
  /**
   * The settings form.
   *
   * @param HTMLElement form The form element.
   */
  var form = document.querySelector(".cldashboard-settings-form");

  /**
   * The settings form.
   *
   * @param HTMLElement form The form element.
   */
  var fields = document.querySelectorAll(
    ".cldashboard-settings-form .general-setting-field"
  );

  /**
   * The submit button.
   *
   * @param HTMLElement form The form element.
   */
  var submitButton = document.querySelector("#submit");

  /**
   * Whether or not the form is currently being submitted.
   */
  var isProcessing = false;

  /**
   * Initialize the module, call the main functions.
   *
   * This function is the only function that should be called on top level scope.
   * Other functions are called / hooked from this function.
   */
  function init() {
    setupColorPicker();
    setupTabsNavigation();

    var bgImageField = document.querySelector(".cldashboard-bg-image-field");
    if (bgImageField) setupMediaField(bgImageField);

    var logoImageField = document.querySelector(
      ".cldashboard-logo-image-field"
    );
    if (logoImageField) setupMediaField(logoImageField);

    setupChainingFields();

    if (form & submitButton) {
      submitButton.classList.add("cldashboard-button");
      form.addEventListener("submit", onSubmit);
    }
  }

  /**
   * Setup color picker for color picker fields.
   */
  function setupColorPicker() {
    $(".color-picker-field").wpColorPicker({
      palettes: true,
      hide: true,
    });
  }

  /**
   * Setup the tabs navigation for settings page.
   */
  function setupTabsNavigation() {
    $(".heatbox-tab-nav-item").on("click", function () {
      $(".heatbox-tab-nav-item").removeClass("active");
      $(this).addClass("active");

      var link = this.querySelector("a");

      if (link.href.indexOf("#") === -1) return;

      var hashValue = link.href.substring(link.href.indexOf("#") + 1);

      if ("tools" === hashValue) {
        $(".cldashboard-settings-form .submit").hide();
      } else {
        $(".cldashboard-settings-form .submit").show();
      }

      $(".heatbox-form-container .heatbox-admin-panel").css("display", "none");

      $(".heatbox-form-container .cldashboard-" + hashValue + "-panel").css(
        "display",
        "block"
      );
    });

    window.addEventListener("load", function () {
      var hashValue = window.location.hash.substring(1);
      var currentActiveTabMenu;

      if (!hashValue) {
        currentActiveTabMenu = document.querySelector(
          ".heatbox-tab-nav-item.active"
        );
        hashValue = currentActiveTabMenu
          ? currentActiveTabMenu.dataset.tab
          : "";
        hashValue = hashValue ? hashValue : "login-screen";
      }

      if ("tools" === hashValue) {
        $(".cldashboard-settings-form .submit").hide();
      } else {
        $(".cldashboard-settings-form .submit").show();
      }

      $(".heatbox-tab-nav-item").removeClass("active");
      $(".heatbox-tab-nav-item.cldashboard-" + hashValue + "-panel").addClass(
        "active"
      );

      $(".heatbox-form-container .heatbox-admin-panel").css("display", "none");

      $(".heatbox-form-container .cldashboard-" + hashValue + "-panel").css(
        "display",
        "block"
      );
    });
  }

  /**
   * Setup media field.
   */
  function setupMediaField(field) {
    var wpMedia;

    wpMedia = wp
      .media({
        title: "Choose Background Image",
        button: {
          text: "Upload Image",
        },
        multiple: false, // Set this to true to allow multiple files to be selected
      })
      .on("select", function () {
        var attachment = wpMedia.state().get("selection").first().toJSON();
        field.value = attachment.url;
        field.dispatchEvent(new Event("change"));
      });

    var uploadButton = field.parentNode.querySelector(
      ".cldashboard-upload-button"
    );

    if (uploadButton) {
      uploadButton.addEventListener("click", function (e) {
        wpMedia.open();
      });
    }

    var clearButton = field.parentNode.querySelector(
      ".cldashboard-clear-button"
    );

    if (clearButton) {
      clearButton.addEventListener("click", function (e) {
        field.value = "";
        field.dispatchEvent(new Event("change"));
      });
    }
  }

  /**
   * Setup fields chaining/ dependency.
   */
  function setupChainingFields() {
    var selectors = [
      "[data-show-if-field]",
      "[data-hide-if-field]",
      "[data-show-if-field-checked]",
      "[data-show-if-field-unchecked]",
    ];

    selectors.forEach(function (selector) {
      var children = document.querySelectorAll(selector);
      if (!children.length) return;

      [].slice.call(children).forEach(function (child) {
        setupChainingEvent(child, selector);
      });
    });
  }

  /**
   * Setup fields chaining event.
   *
   * @param {HTMLElement} child The children element.
   * @param selector child The selector that belongs to the children element.
   */
  function setupChainingEvent(child, selector) {
    var parentName = child.getAttribute(
      selector.replace("[", "").replace("]", "")
    );
    var parentField = document.querySelector("#" + parentName);

    var shownDisplayType = window.getComputedStyle(child).display;
    shownDisplayType = shownDisplayType ? shownDisplayType : "block";

    checkChainingState(child, shownDisplayType, parentField);

    if (parentField.classList.contains("use-select2")) {
      $(parentField).on("change", function (e) {
        checkChainingState(child, shownDisplayType, parentField);
      });
    } else {
      parentField.addEventListener("change", function (e) {
        checkChainingState(child, shownDisplayType, parentField);
      });
    }
  }

  /**
   * Check the children state: shown or hidden.
   *
   * @param {HTMLElement} child The children element.
   * @param string shownDisplayType The display type of child when it's shown (e.g: "flex" or "block").
   * @param {HTMLElement} parent The parent/ dependency element.
   */
  function checkChainingState(child, shownDisplayType, parent) {
    var parentTagName = parent.tagName.toLocaleLowerCase();

    if (parentTagName === "input" && parent.type === "checkbox") {
      // Handle "data-show-if-field-checked".
      if (child.hasAttribute("data-show-if-field-checked")) {
        if (parent.checked) {
          child.style.display = shownDisplayType;
        } else {
          child.style.display = "none";
        }
      } else {
        // Handle "data-show-if-field-unchecked".
        if (!parent.checked) {
          child.style.display = shownDisplayType;
        } else {
          child.style.display = "none";
        }
      }

      return;
    }

    var wantedValue = child.hasAttribute("data-show-if-field")
      ? child.dataset.showIfValue
      : child.dataset.hideIfValue;
    var parentValue;

    if (parentTagName === "select") {
      if (parent.multiple) {
        parentValue = $(parent).val();
        wantedValue = JSON.parse(wantedValue);
      } else {
        if (parent.selectedIndex > -1) {
          parentValue = parent.options[parent.selectedIndex].value;
        }
      }
    } else {
      parentValue = parent.value;
    }

    // Handle "data-show-if-field".
    if (child.hasAttribute("data-show-if-field")) {
      if (parentValue === wantedValue) {
        child.style.display = shownDisplayType;
      } else {
        child.style.display = "none";
      }
    } else {
      // Handle "data-hide-if-field".
      if (JSON.stringify(parentValue) === JSON.stringify(wantedValue)) {
        child.style.display = "none";
      } else {
        child.style.display = shownDisplayType;
      }
    }
  }

  function startLoading() {
    if (submitButton) submitButton.classList.add("is-loading");
  }

  function stopLoading() {
    if (submitButton) submitButton.classList.remove("is-loading");
  }

  /**
   * Function to run on form submit.
   *
   * @param Event e The event object.
   */
  function onSubmit(e) {
    e.preventDefault();
    if (isProcessing) return;
    isProcessing = true;
    startLoading();

    var data = {};

    [].slice.call(fields).forEach(function (field) {
      var value = false;

      if (field.tagName.toLoweCase() === "select") {
        if (field.multiple) {
          value = JSON.stringify($(field).val());
        } else {
          if (field.selectedIndex) {
            value = field.options[field.selectedIndex].value;
          } else {
            value = field.value;
          }
        }
      } else {
        if (field.type === "checkbox" || field.type === "radio") {
          if (field.checked) {
            value = field.value;
          }
        } else {
          value = field.value;
        }
      }

      if (value !== false) data[field.name] = value;
    });

    data.action = "cldashboard_save_settings";
    data.nonce = CustomLoginDashboard.nonces.saveSettings;

    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: data,
    })
      .done(function (r) {
        if (!r || !r.success) return;
      })
      .fail(function (jqXHR) {
        var errorMesssage = "Something went wrong";

        if (jqXHR.responseJSON && jqXHR.responseJSON.data) {
          errorMesssage = jqXHR.responseJSON.data;
        }
      })
      .always(function () {
        isProcessing = false;
        stopLoading();
      });
  }

  // Run the module.
  init();
})(jQuery);
