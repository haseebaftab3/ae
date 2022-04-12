//!! Register
$(".Regi_User").submit(function (e) {
  e.preventDefault();
  var id = "RegisterAlert";
  RemoveAlerts(id);
  e.preventDefault();
  $.ajax({
    url: "backend/insert/Register.php",
    method: "post",
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        SuccessAlert(response.msg, id);
      } else if (response.status == "error") {
        DangerAlert(response.msg, id);
      }
    },
  });
});

// !!Review
$(".product-review-user").submit(function (e) {
  e.preventDefault();
  id = "RatingReview-alert";
  if ($(".rating__input").val() != "") {
    $.ajax({
      url: "backend/insert/Rating.php",
      method: "post",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          SuccessAlert(response.msg, id);
        } else if (response.status == "error") {
          DangerAlert(response.msg, id);
        }
      },
    });
  } else {
    DangerAlert("All feilds required", id);
  }
});

// !!Fetch Selected Color:
$(".swatch_Color_Fetch").change(function () {
  $(".CartProductColor").val($(this).val());
});

// !! Add To Cart
$(".Add_To_Cart_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("Detail_main_alert");
  $.ajax({
    url: "backend/insert/AddToCart.php",
    method: "POST",
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        console.log(response);
        location.reload();
      }
    },
  });
});

// Update Cart Quantity

$(".Cart_Upate_btn").click(function (e) {
  e.preventDefault();
  RemoveAlerts("msg_Cart_Qun");
  var CrrIndex = $(this).attr("data-id");
  var Qun = $(".CartQuantity" + CrrIndex).val();

  $.ajax({
    url: "backend/update/Update_Cart_Quantity.php",
    method: "POST",
    data: { CrrIndex: CrrIndex, Qun: Qun },
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        location.reload();
      } else {
        DangerAlert(response.msg, "msg_Cart_Qun");
      }
    },
  });
});

// Search

$(function () {
  $(".MainSearchINput").keyup(function () {
    var val = $(this).val();
    var drop = $(".ChangeCatStatusSearch").val();
    console.log(val);
    $.ajax({
      method: "POST",
      data: { val: val, drop: drop },
      url: "backend/fetch/search.php",
      success: function (response) {
        response = $.parseJSON(response);
        console.log(response);
        if (response.status == "success" && response.html !== "") {
          // alert("A");
          $(".ChangeDisStatusSearch").css("display", "unset");
          $(".LoadSearchCont").html(response.html);
        } else {
          $(".LoadSearchCont").html(response.html);
        }
      },
    });
  });
});

//!! Change Amp
$(".Amp-Option-Select").change(function (e) {
  e.preventDefault();
  var unit_price = parseFloat($(this).val()).toFixed(2);
  var total_price = parseInt(
    $(this).find(":selected").attr("data-TotalPrice")
  ).toFixed(2);
  var total_quantity = $(this).find(":selected").attr("data-Quantity");
  var sale_val = parseInt($(".Sale_Of_Value").val()).toFixed(2);
  $(".change_unit_price").html(formatMoney("Rs. " + unit_price));
  $(".change_unit_Quntity").html(formatMoney(total_quantity));

  //?Set Hidden Values
  $(".Hidden_Unit_Price").val(unit_price);
  $(".Hidden_Unit_Quantity").val(total_quantity);

  if ($(".Sale_Of_Value").val() != undefined) {
    var SalePrice = (sale_val / 100) * total_price;
    var OffVal = formatMoney(Math.round(total_price - SalePrice).toFixed(2));
    $(".Old_Product_Price").html(formatMoney(total_price));
    $(".product-price").html("Rs. " + formatMoney(OffVal));

    //?Set Hidden Values
    $(".CartProductUpdatedPrice").val(OffVal);
  } else {
    $(".product-price").html("Rs. " + formatMoney(total_price));
    //?Set Hidden Values
    $(".CartProductUpdatedPrice").val(total_price);
  }
});

// !!Login & Register

$(".RegForm").on("submit", function (e) {
  // alert("aa");
  e.preventDefault();
  RemoveAlerts("Account-Alert");
  $.ajax({
    url: "backend/fetch/login.php",
    method: "POST",
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      // console.log(response);
      if (response.status == "success") {
        // SuccessAlert(response.msg, "Account-Alert");
        // location.reload();
        window.location.href = "index.php";
      } else if (response.status == "error") {
        DangerAlert(response.msg, "Account-Alert");
      } else if (response.status == "login") {
        window.location.href = "index.php";
      }
    },
  });
});

// Update Email Pass My account
$(".Edit_Account_Credential").submit(function (e) {
  RemoveAlerts("MyAccount-Alert");
  e.preventDefault();
  $.ajax({
    url: "backend/update/AccountCredntials.php",
    method: "POST",
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        SuccessAlert(response.msg, "MyAccount-Alert");
        Scrolltop(500);
      } else if (response.status == "error") {
        DangerAlert(response.msg, "MyAccount-Alert");
        Scrolltop(500);
      }
    },
  });
});

//!! Quick Veiw Model
$(function () {
  var i = 0;
  $(".Quick_Veiw_Btn, .Quick_Veiw_Icon").click(function (e) {
    var Quick_ID = $(e.target).data("id");
    $.ajax({
      url: "backend/fetch/QuickView.php",
      method: "POST",
      data: { Quick_ID: Quick_ID },
      beforeSend: function () {
        i++;
        $(".Quick_Veiw_ModalContent").css("display", "none");
        $(".Loading-QucikView").css("display", "unset");
      },
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          $(".Quick_Veiw_ModalContent").html(response.html);
        } else if (response.status == "error") {
          $(".Quick_Veiw_ModalContent").html(response.html);
        }
      },
      error: function (xhr) {
        // if error occured
        $(".Quick_Veiw_ModalContent").css("display", "unset");
        $(".Quick_Veiw_ModalContent").html(
          `<div class="section-404 section" data-bg-image="assets/images/bg/bg-404.jpg">
      <div class="container">
          <div class="content-404">
              <h1 class="title">Oops!</h1>
              <h2 class="sub-title">Error!</h2>
              <p>` +
            xhr.statusText +
            xhr.responseText +
            `</p>
              <div class="buttons">
                  <a class="btn btn-primary btn-outline-hover-dark" data-dismiss="modal" href="javascript:void(0);">Dissmiss</a>
              </div>
          </div>
      </div>
  </div>`
        );
        $(".Loading-QucikView").css("display", "none");
      },
      complete: function () {
        i--;
        if (i <= 0) {
          // Reinitalize Quick View Slider
          $(".product-gallery-slider-quickview").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow:
              '<button class="slick-prev"><i class="ti-angle-left"></i></button>',
            nextArrow:
              '<button class="slick-next"><i class="ti-angle-right"></i></button>',
          });

          $(".Quick_Veiw_ModalContent").css("display", "unset");
          $(".Loading-QucikView").css("display", "none");
          //? */ Re Initialize JS (Theme)
          $(".customScroll").perfectScrollbar({
            suppressScrollX: !0,
          });

          //? Product Quantity
          $(".qty-btn").on("click", function () {
            var $this = $(this);
            var oldValue = $this.siblings("input").val();
            if ($this.hasClass("plus")) {
              var newVal = parseFloat(oldValue) + 1;
            } else {
              // Don't allow decrementing below zero
              if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
              } else {
                newVal = 1;
              }
            }
            $this.siblings("input").val(newVal);
          });
          // Validation
          var OrgQun = $(".QucikMaxvalue").val();
          if ($(".input-qtyQuickVeiw").val() <= OrgQun) {
            $(".MinusQuntBtnQuickVeiw").css("display", "none");
          } else {
            $(".MinusQuntBtnQuickVeiw").css("display", "unset");
          }
          $(".input-qtyQuickVeiw").change(function (e) {
            if ($(".input-qtyQuickVeiw").val() <= OrgQun) {
              $(".MinusQuntBtnQuickVeiw").css("display", "none");
              $(".input-qtyQuickVeiw").val(OrgQun);
            } else {
              $(".MinusQuntBtnQuickVeiw").css("display", "unset");
            }
          });

          $(".MinusQuntBtnQuickVeiw").click(function () {
            if ($(".input-qtyQuickVeiw").val() <= OrgQun) {
              $(".MinusQuntBtnQuickVeiw").css("display", "none");
            } else {
              $(".MinusQuntBtnQuickVeiw").css("display", "unset");
            }
          });
          $(".PlusQuntBtnQuickVeiw").click(function () {
            if ($(".input-qtyQuickVeiw").val() <= OrgQun) {
              $(".MinusQuntBtnQuickVeiw").css("display", "none");
            } else {
              $(".MinusQuntBtnQuickVeiw").css("display", "unset");
            }
          });
          $(".swatch_Color_Fetch").change(function () {
            $(".CartProductColor").val($(this).val());
          });
          // !! Add To Cart
          $(".Add_To_Cart_Form").on("submit", function (e) {
            e.preventDefault();
            RemoveAlerts("Detail_main_alert");
            $.ajax({
              url: "backend/insert/AddToCart.php",
              method: "POST",
              data: new FormData(this),
              cache: false,
              contentType: false,
              processData: false,
              success: function (response) {
                response = $.parseJSON(response);
                if (response.status == "success") {
                  console.log(response);
                  // alert("aa");
                  location.reload();
                }
              },
            });
          });

          //!! Change Amp
          $(".Amp-Option-Select").change(function (e) {
            e.preventDefault();
            var unit_price = parseFloat($(this).val()).toFixed(2);
            var total_price = parseInt(
              $(this).find(":selected").attr("data-TotalPrice")
            ).toFixed(2);
            var total_quantity = $(this)
              .find(":selected")
              .attr("data-Quantity");
            var sale_val = parseInt($(".Sale_Of_Value").val()).toFixed(2);
            $(".change_unit_price").html(formatMoney("Rs. " + unit_price));
            $(".change_unit_Quntity").html(formatMoney(total_quantity));

            //?Set Hidden Values
            $(".Hidden_Unit_Price").val(unit_price);
            $(".Hidden_Unit_Quantity").val(total_quantity);

            if ($(".Sale_Of_Value").val() != undefined) {
              var SalePrice = (sale_val / 100) * total_price;
              var OffVal = formatMoney(
                Math.round(total_price - SalePrice).toFixed(2)
              );
              $(".Old_Product_Price").html(formatMoney(total_price));
              $(".product-price").html("Rs. " + formatMoney(OffVal));

              //?Set Hidden Values
              $(".CartProductUpdatedPrice").val(OffVal);
            } else {
              $(".product-price").html("Rs. " + formatMoney(total_price));
              //?Set Hidden Values
              $(".CartProductUpdatedPrice").val(total_price);
            }
          });
        }
      },
    });
  });
});

// !!Place Order
$("#PlaceOrderbtn").click(function (e) {
  e.preventDefault();
  RemoveAlerts("CheckOutAlert");
  var i = 0;

  var OrderType = "";
  // Order Type
  if ($("#cashkPayments").hasClass("show")) {
    OrderType = "COD";
  } else if ($("#checkPayments").hasClass("show")) {
    OrderType = "Online";
  } else {
    OrderType = "NAN";
  }
  if (OrderType == null || OrderType == "NAN") {
    DangerAlert("Please Select At least one order type", "CheckOutAlert");
    Scrolltop("500");
  } else {
    var FName = $("#bdFirstName").val();
    var Uid = $("#bdUserId").val();
    var CName = $("#bdCompanyName").val();
    var Country = $("#bdCountry").val();
    var Address1 = $("#bdAddress1").val();
    var Address2 = $("#bdAddress2").val();
    var District = $("#bdDistrict").val();
    var bdPostcode = $("#bdPostcode").val();
    var Email = $("#bdEmail").val();
    var Phone = $("#bdPhone").val();
    var Order_Notes = $("#bdOrderNote").val();
    if (
      FName != "" &&
      FName != null &&
      Country != "" &&
      Country != null &&
      Address1 != "" &&
      Address1 != null &&
      District != "" &&
      District != null &&
      Email != "" &&
      Email != null &&
      Phone != "" &&
      Phone != null
    ) {
      $.ajax({
        url: "backend/insert/Order.php",
        method: "POST",
        data: {
          FName: FName,
          CName: CName,
          Country: Country,
          Address1: Address1,
          Address2: Address2,
          District: District,
          bdPostcode: bdPostcode,
          Email: Email,
          Phone: Phone,
          Order_Notes: Order_Notes,
          Uid: Uid,
          OrderType: OrderType,
        },
        beforeSend: function () {
          // setting a timeout
          $(".MainContainer-Vis").addClass("d-none");
          $(".Preloader-container").removeClass("d-none");
          i++;
        },
        success: function (response) {
          response = $.parseJSON(response);
          console.log(response);
          if (response.status == "success") {
            SuccessAlert(response.msg, "CheckOutAlert");
            Scrolltop(500);
          } else if (response.status == "error") {
            DangerAlert(response.msg, "CheckOutAlert");
            Scrolltop(500);
          }
        },
        error: function (xhr) {
          // if error occured
          DangerAlert(
            response.msg,
            "Error occured.please try again <br> Error Status/Type:  (" +
              xhr.statusText +
              xhr.responseText
          ) + ")";
          Scrolltop(500);
          // $(placeholder).removeClass('loading');
        },
        complete: function () {
          i--;
          if (i <= 0) {
            window.location.href = "./index.php";
          }
        },
      });
    } else {
      DangerAlert("All feilds Are Requirres", "CheckOutAlert");
      Scrolltop("500");
    }
  }
});

// !! Lasy Loading
document.addEventListener("DOMContentLoaded", function () {
  var lazyloadImages = document.querySelectorAll("img.lazy");
  var lazyloadThrottleTimeout;

  function lazyload() {
    if (lazyloadThrottleTimeout) {
      clearTimeout(lazyloadThrottleTimeout);
    }

    lazyloadThrottleTimeout = setTimeout(function () {
      var scrollTop = window.pageYOffset;
      lazyloadImages.forEach(function (img) {
        if (img.offsetTop < window.innerHeight + scrollTop) {
          img.src = img.dataset.src;
          img.classList.remove("lazy");
        }
      });
      if (lazyloadImages.length == 0) {
        document.removeEventListener("scroll", lazyload);
        window.removeEventListener("resize", lazyload);
        window.removeEventListener("orientationChange", lazyload);
      }
    }, 20);
  }

  document.addEventListener("scroll", lazyload);
  window.addEventListener("resize", lazyload);
  window.addEventListener("orientationChange", lazyload);
});

//  Force page scroll position to top at page refresh in HTML ...
$(document).ready(function () {
  $(this).scrollTop(0);
});

//  !!m Preloader

// $(function (e) {
//   const a = e(window),
//     o = e("body"),
//     i = {
//       animateTextAjax:
//         '.dsn-nav-bar , .headefr-fexid .project-title .title-text-header .cat ,[data-dsn-animate="ajax"] , footer, .next-project , .root-project',
//     };
//   $(function () {
//     var t = e(".preloader"),
//       n = t.find(".preloader-block"),
//       o = n.find(".percent"),
//       i = n.find(".title"),
//       s = n.find(".loading"),
//       r = t.find(".preloader-bar"),
//       l = r.find(".preloader-progress"),
//       d = t.find(".preloader-after"),
//       c = t.find(".preloader-before"),
//       u = dsnGrid.pageLoad(0, 100, 300, function (e) {
//         o.text(e), l.css("width", e + "%");
//       });
//     a.on("load", function () {
//       clearInterval(u),
//         TweenMax.fromTo(
//           l,
//           0.5,
//           { width: "95%" },
//           {
//             width: "100%",
//             onUpdate: function () {
//               var e = (l.width() / l.parent().width()) * 100;
//               o.text(parseInt(e, 10));
//             },
//             onComplete: function () {
//               TweenMax.to(r, 0.5, { left: "100%" }),
//                 TweenMax.to(i, 1, { autoAlpha: 0, y: -100 }),
//                 TweenMax.to(s, 1, { autoAlpha: 0, y: 100 }),
//                 TweenMax.to(o, 1, { autoAlpha: 0 }),
//                 TweenMax.to(c, 1, { y: "-100%", delay: 0.7 }),
//                 TweenMax.to(d, 1, {
//                   y: "100%",
//                   delay: 0.7,
//                   onComplete: function () {
//                     t.addClass("d-none");
//                   },
//                 });
//             },
//           }
//         );
//     });
//   });
// });

// !!!! --- !!!!!:::::""""~~FUnCtIonS~~** --- !!!!!:::::""""

function Scrolltop(val) {
  $("html, body").animate({ scrollTop: val }, 500, "swing");
}

// Close Modal
function CloseModals(id) {
  $("#" + id).modal("hide");
}
// Remove Dropify image
function RemoveDropify() {
  $(".dropify-preview").css("display", "none");
}
// Reset Form
function ResetForm(id) {
  document.getElementById(id).reset();
}
//Toast
function ManageTost(message) {
  $(".custom-toast").removeClass("hide");
  $(".custom-toast").addClass("show");
  $(".custom-toast-msg").html(message);
  setTimeout(function () {
    $(".custom-toast").removeClass("show");
    $(".custom-toast").addClass("hide");
  }, 6000);
}

//Dismiss Toast
$(".custom-toast-dismiss").click(function (e) {
  $(".custom-toast").removeClass("show");
  $(".custom-toast").addClass("hide");
});
//Spinner
function Spinner() {
  $("#preloader_refresh").css("display", "table-row-group");
  $("#Table_data").css("display", "none");
  $(".icon-refresh-tool").addClass("mdi-spin");
  setTimeout(function () {
    $("#preloader_refresh").css("display", "none");
    $("#Table_data").css("display", "table-row-group");
    $(".icon-refresh-tool").removeClass("mdi-spin");
  }, 2000);
}

// !!DataTabels

// Distroy Data Table
function DisDataTabels(id) {
  $("#" + id)
    .dataTable()
    .fnDestroy();
}
// Data Tables Re-Initialize
function DataTabels() {
  $("#basic-datatable").DataTable({
    language: {
      paginate: {
        previous: "<i class='mdi mdi-chevron-left'>",
        next: "<i class='mdi mdi-chevron-right'>",
      },
    },
    drawCallback: function () {
      $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
    },
  });
  var a = $("#datatable-buttons").DataTable({
    lengthChange: !1,
    buttons: ["copy", "pdf"],
    language: {
      paginate: {
        previous: "<i class='mdi mdi-chevron-left'>",
        next: "<i class='mdi mdi-chevron-right'>",
      },
    },
    drawCallback: function () {
      $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
    },
  });
  $("#selection-datatable").DataTable({
    select: { style: "multi" },
    language: {
      paginate: {
        previous: "<i class='mdi mdi-chevron-left'>",
        next: "<i class='mdi mdi-chevron-right'>",
      },
    },
    drawCallback: function () {
      $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
    },
  }),
    $("#key-datatable").DataTable({
      keys: !0,
      language: {
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'>",
          next: "<i class='mdi mdi-chevron-right'>",
        },
      },
      drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
      },
    }),
    a
      .buttons()
      .container()
      .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
    $("#complex-header-datatable").DataTable({
      language: {
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'>",
          next: "<i class='mdi mdi-chevron-right'>",
        },
      },
      drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
      },
      columnDefs: [{ visible: !1, targets: -1 }],
    }),
    $("#state-saving-datatable").DataTable({
      stateSave: !0,
      language: {
        paginate: {
          previous: "<i class='mdi mdi-chevron-left'>",
          next: "<i class='mdi mdi-chevron-right'>",
        },
      },
      drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
      },
    });
}

/**{{Alerts(start)}}**/

//Success Alert
function SuccessAlert(message, id) {
  var Alert_ID = $("#" + id);
  Alert_ID.addClass("alert");
  Alert_ID.addClass("alert-success");
  Alert_ID.html(message);
}

//Danger Alert
function DangerAlert(message, id) {
  var Alert_ID = $("#" + id);
  Alert_ID.addClass("alert");
  Alert_ID.addClass("alert-danger");
  Alert_ID.html(message);
}

//Remove Alerts
function RemoveAlerts(id) {
  var Alert_ID = $("#" + id);
  Alert_ID.removeClass("alert");
  Alert_ID.removeClass("alert-danger");
  Alert_ID.removeClass("alert-success");
  Alert_ID.html("");
}

function formatMoney(number) {
  return number.toLocaleString();
}

window.onload = function () {
  //hide the preloader
  document.querySelector(".loader-container").style.display = "none";
  $("body").css("background-color", "#FFF");
  document.querySelector(".after-loader").style.display = "unset";
  // Home 4 Slider
  var $home4Slider = new Swiper(".home4-slider", {
    loop: true,
    loopedSlides: 2,
    speed: 750,
    spaceBetween: 200,
    pagination: {
      el: ".home4-slider-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".home4-slider-next",
      prevEl: ".home4-slider-prev",
    },
    autoplay: {},
  });
};

// toggleFab();

//Fab click
$("#prime").click(function () {
  toggleFab();
});

//Toggle chat and links
function toggleFab() {
  $(".prime").toggleClass("is-active");
  $("#prime").toggleClass("is-float");
  $(".fab").toggleClass("is-visible");
}

// Ripple effect
var target, ink, d, x, y;
$(".fab").click(function (e) {
  target = $(this);
  //create .ink element if it doesn't exist
  if (target.find(".ink").length == 0)
    target.prepend("<span class='ink'></span>");

  ink = target.find(".ink");
  //incase of quick double clicks stop the previous animation
  ink.removeClass("animate");

  //set size of .ink
  if (!ink.height() && !ink.width()) {
    //use parent's width or height whichever is larger for the diameter to make a circle which can cover the entire element.
    d = Math.max(target.outerWidth(), target.outerHeight());
    ink.css({
      height: d,
      width: d,
    });
  }

  //get click coordinates
  //logic = click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center;
  x = e.pageX - target.offset().left - ink.width() / 2;
  y = e.pageY - target.offset().top - ink.height() / 2;

  //set the position and add class .animate
  ink
    .css({
      top: y + "px",
      left: x + "px",
    })
    .addClass("animate");
});
