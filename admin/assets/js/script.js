// Java Script Document
// !!AdmIn Panal
//--1)Category

//Fetch_Parent_Categories
Fetch_Parent_Categories();
function Fetch_Parent_Categories() {
  $.ajax({
    method: "POST",
    url: "back-end/fetch/Fetch_Parent_Categories.php",
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        $("#Cat_Parent").html(response.html);
        $(".ESale_Parent").html(response.html);
        $("#Edit_Cat_Parent").html(response.html);
        $(".Cat_Parent").html(response.html);
      } else if (response.status == "error") {
        $("#Cat_Parent").html(response.html);
        $("#Edit_Cat_Parent").html(response.html);
      }
    },
  });
}

// Fetch Products DropDown
Fetch_ProductsDD();
function Fetch_ProductsDD() {
  $.ajax({
    method: "POST",
    url: "back-end/fetch/Fetch_ProductsDD.php",
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        $(".Products_ParentDD").html(response.html);
      } else if (response.status == "error") {
        $(".Products_ParentDD").html(response.html);
      }
    },
  });
}

// Fetch Manufacture DropDown
Fetch_ManufactureDD();
function Fetch_ManufactureDD() {
  $.ajax({
    method: "POST",
    url: "back-end/fetch/Fetch_ManufactureDD.php",
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        $(".Manufacture_ParentDD").html(response.html);
      } else if (response.status == "error") {
        $(".Manufacture_ParentDD").html(response.html);
      }
      // console.log(response);
    },
  });
}
//Insert_ToggleButton(StatusBtn)
$("#Cat_Status").change(function () {
  if ($(this).prop("checked") == true) {
    $(this).val("True");
  } else if ($(this).prop("checked") == false) {
    $(this).val("False");
  }
});

// !!Fetch
FetchCatData();
function FetchCatData() {
  $.ajax({
    url: "back-end/fetch/categries.php",
    method: "GET",
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        Spinner();
        DisDataTabels("datatable-buttons");
        $(".Table_Data").html(response.html);
        DataTabels();

        //!! Change Status
        // !--Change Cat Status
        $(".ChangeCommentStatus").on("change", function (event) {
          // r.preventDefault();
          var $anchor = $(event.target).parent(".switch");
          var id = $anchor.attr("data-id");
          if ($(".ChangeCommentStatus").prop("checked") == true) {
            $.ajax({
              method: "POST",
              data: { id: id, val: "True" },
              url: "back-end/update/Categories_Status.php",
              success: function (response) {
                response = $.parseJSON(response);
                if (response.status == "success") {
                  ManageTost(response.msg);
                } else if (response.status == "error") {
                  ManageTost(response.msg);
                }
              },
            });
          } else {
            $.ajax({
              method: "POST",
              data: { id: id, val: "False" },
              url: "back-end/update/Categories_Status.php",
              success: function (response) {
                response = $.parseJSON(response);
                if (response.status == "success") {
                  ManageTost(response.msg);
                } else if (response.status == "error") {
                  ManageTost(response.msg);
                }
              },
            });
          }
        });
      } else if (response.status == "empty") {
        Spinner();
      }
    },
  });
}

//!!Refresh
$(".icon-refresh-tool").on("click", function () {
  FetchCatData();
});
// Getting Id

//Getting ID
$(".Cat_Table").on("click", function (event) {
  // event.preventDefault();
  var $anchor = $(event.target).parent(".CommentIcon");
  var id = $anchor.attr("data-id");
  if (id != "" || id != null) {
    // console.log(id);
    if (id != undefined) {
      $.ajax({
        method: "POST",
        data: { id: id },
        url: "back-end/fetch/categories-id.php",
        success: function (response) {
          response = $.parseJSON(response);
          $(".Cat-ID").val(id);
          if (response.status == "success") {
            $("#Edit_Cat_Name").val(response.Name);
            if (response.Parent_id == null || response.Parent_id == "NULL") {
              $("#Edit_Cat_Parent").val("NULL").trigger("change");
            } else {
              $("#Edit_Cat_Parent").val(response.Parent_id).trigger("change");
            }
            $("#Edit_Cat_Order").val(response.Sort_Order);
            $("#Edit_Cat_Des").val(response.Discription);
          } else if (response.status == "error") {
            $("#Cat_Parent").html(response.html);
          }
        },
      });
    }
  }
});
// !!Insert
$("#Insert_Cat_Form").submit(function (e) {
  e.preventDefault();

  if ($("#Cat_Name").val() != "") {
    $.ajax({
      method: "POST",
      data: new FormData(this),
      url: "back-end/insert/categories.php",
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          $("#Cat_Parent").html(response.html);
          $("#AddCatModal").modal("hide");
          ManageTost(response.msg);
          $("#Insert_Cat_Form")[0].reset();
        } else if (response.status == "error") {
          $("#Cat_Parent").html(response.html);
        }
        Fetch_Parent_Categories();
        FetchCatData();
      },
    });
  }
});

// !!EDIT
$("#Edit_Cat_Form").submit(function (e) {
  e.preventDefault();
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/update/categories.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("EditCatModal");
        ResetForm("Edit_Cat_Form");
        RemoveDropify();
      } else if (response.status == "error") {
        ManageTost(response.msg);
      }
      FetchCatData();
      Fetch_Parent_Categories();
    },
  });
});

// ?? Delete
$(".Delete_Cat_Form").submit(function (e) {
  e.preventDefault();
  // RemoveAlerts("Remove-Sales-Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/delete/Categories.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("Delete_Cat_Form");
        FetchCatData();
        Fetch_Parent_Categories();
        // $("Cat_Table").
        // $(".Cat_Table").DataTable().ajax.reload();
        window.location.reload();
      } else if (response.status == "error") {
        CloseModals("Delete_Cat_Form");
        ManageTost(response.msg);
      }
      FetchCatData();
    },
  });
});

// !!{{{{{{{{{{{{{{{{{{{{{{{{{{{**************Products**************}}}}}}}}}}}}}}}}}}}}}}}}}}}
// ?? Insert
$("#Insert_Product_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("Insert-Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/insert/products.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      // console.log(response);
      if (response.status == "success") {
        CloseModals("AddProductModal");
        ManageTost(response.msg);
        RemoveDropify();
        ResetForm("Insert_Product_Form");
      } else if (response.status == "error") {
        // ManageTost(response.msg);
        DangerAlert(response.msg, "Insert-Alert");
      }
      ProductsData();
    },
  });
});

// !! Dynamic Form Color
var DyNumber = 1;
$(document).ready(function () {
  $(".AddDyColor").click(function (e) {
    DyNumber++;
    e.preventDefault();
    $(".Color_InputAdmin").append(
      '<div class="col-12 border p-2 mt-2 DyColorArea' +
        DyNumber +
        '" style="position: relative;">\
    <i class="mdi mdi-minus-circle text-danger pr-1 RemoveDyColor" data-id="' +
        DyNumber +
        '" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;z-index:99999"></i>\
      <div class="row">\
       <div class="col-6 ">\
            <label for="Product_Order">\
              Name \
            </label>\
            <input type="text" name="Color[]" class="form-control">\
        </div>\
        <div class="col-6 ">\
        <label for="Product_Order">\
        Price (+ / -)\
        </label>\
        <input type="text" placeholder="" name="Color_Value[]"  class="form-control">\
    </div>\
    <div class="col-6 ">\
    <label for="Product_Order">\
        Colorcode\
    </label>\
    <input type="text" placeholder="" name="ColorCode[]" class="form-control ">\
</div>\
  </div>\
</div>'
    );
    $(".RemoveDyColor").on("click", function (e) {
      e.preventDefault();
      var CrrNum = $(this).attr("data-id");
      $(".DyColorArea" + CrrNum).remove();
    });
  });
});
// !! Color

// !! Dynamic Form Amp
var DyNumberA = 1;
$(document).ready(function () {
  $(".AddDyAmp").click(function (e) {
    DyNumberA++;
    e.preventDefault();
    $(".Amp_InputAdmin").append(
      '<div class="col-12 border p-2 mt-2 DyAmpArea' +
        DyNumberA +
        '" style="position: relative;">\
    <i class="mdi mdi-minus-circle text-danger pr-1 RemoveDyAmp" data-id="' +
        DyNumberA +
        '" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;z-index:99999"></i>\
      <div class="row">\
       <div class="col-6 ">\
            <label for="Product_Order">\
              Name \
            </label>\
            <input type="text" name="Amp[]" class="form-control">\
        </div>\
        <div class="col-6 ">\
        <label for="Product_Order">\
        Price (Total)\
        </label>\
        <input type="text" placeholder="" name="AddDyAmp[]"  class="form-control autonumber">\
    </div>\
    <div class="col-6 ">\
    <label for="Product_Order">\
        Quantity\
    </label>\
    <input type="text" placeholder="" name="Amp_Quantity[]" class="form-control ">\
</div>\
  </div>\
</div>'
    );
    $(function (a) {
      a(".autonumber").autoNumeric("init");
    }),
      $(".RemoveDyAmp").on("click", function (e) {
        e.preventDefault();
        var CrrNum = $(this).attr("data-id");
        $(".DyAmpArea" + CrrNum).remove();
      });
  });
});
// !! Color

// !! Size Form Color
var DyNumberS = 1;
$(document).ready(function () {
  $(".AddDySize").click(function (e) {
    DyNumberS++;
    e.preventDefault();
    $(".Size_InputAdmin").append(
      '<div class="col-12 border p-2 mt-2 DySizeArea' +
        DyNumberS +
        '" style="position: relative;">\
    <i class="mdi mdi-minus-circle text-danger pr-1 RemoveDySize" data-id="' +
        DyNumberS +
        '" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;z-index:99999"></i>\
      <div class="row">\
       <div class="col-6 ">\
            <label for="Product_Order">\
              Name \
            </label>\
            <input type="text" name="Size[]" class="form-control">\
        </div>\
        <div class="col-6 ">\
        <label for="Product_Order">\
        Price (+ / -)\
        </label>\
        <input type="text" placeholder="" name="Size_Value[]"  class="form-control">\
    </div>\
  </div>\
</div>'
    );
    $(function (a) {
      a(".autonumber").autoNumeric("init");
    }),
      $(".RemoveDySize").on("click", function (e) {
        e.preventDefault();
        var CrrNum = $(this).attr("data-id");
        $(".DySizeArea" + CrrNum).remove();
      });
  });
});
// !! Size
// ?? Fetch
ProductsData();
function ProductsData() {
  $.ajax({
    url: "back-end/fetch/Products.php",
    method: "GET",
    success: function (response) {
      response = $.parseJSON(response);
      console.log(response);
      if (response.status == "success") {
        Spinner();
        DisDataTabels("datatable-buttons");
        $(".Product_Table_Data").html(response.html);
        DataTabels();
      } else if (response.status == "empty") {
        Spinner();
      }
    },
  });
}

//Getting ID
$(".Product_Table").on("click", function (event) {
  event.preventDefault();
  var $anchor = $(event.target).parent(".CommentIcon");
  var id = $anchor.attr("data-id");
  if (id != "" || id != null) {
    // console.log(id);
    if (id != undefined) {
      $(".PUse-ID").val(id);
      $(".Product-Common-ID").val(id);
      $.ajax({
        method: "POST",
        data: { id: id },
        url: "back-end/fetch/Product-id.php",
        success: function (response) {
          response = $.parseJSON(response);

          if (response.status == "success") {
            $("#EProductName").val(response.Name);
            $("#EProductModel").val(response.Model);
            $("#EUnitPrice").val(response.UnitPrice);
            $("#EUnitQuantity").val(response.Unit_Quantity);
            -$("#EProductMetalTitle").val(response.MetaTitle);
            $("#ECatAppend").append(
              "<option value='" +
                response.Category_ID +
                "' selected readonly>" +
                response.Category_Name +
                "</option>"
            );
            $("#EProductPrice").val(response.Price);
            $("#EProductDiscription").val(response.Description);
            // alert(response.Manufacture_Name);
            $(".EProductManufacture_ParentDD").append(
              "<option value='" +
                response.Manufacture_ID +
                "' selected readonly>" +
                response.Manufacture_Name +
                " (Selected)" +
                "</option>"
            );
            $("#EProduct_SortOrder").val(response.SortOrder);
            $("#EProduct_Quantity").val(response.Quantity);
            $(".EShippingPrice").val(response.ShippingPrice);
            $("#EProduct_MinQuantity").val(response.Minimum);
            $("#EProduct_MinQuantity").val(response.Minimum);
            if (response.Subtract === "Yes") {
              $("#EStockRadio").prop("checked", true);
            } else {
              $("#EStockRadio1").prop("checked", true);
            }
            // Shipping
            if (response.Shipping === "Yes") {
              $("#EShipRadio").prop("checked", true);
            } else {
              $("#EShipRadio1").prop("checked", true);
            }
          } else if (response.status == "error") {
            $("#Cat_Parent").html(response.html);
          }

          $("#EProduct_StockStatus").append(
            "<option value='" +
              response.Stock_staus +
              "' selected readonly>" +
              response.Stock_staus +
              "</option>"
          );
          // Length Class
          $("#EProduct_LengthClass").append(
            "<option value='" +
              response.LengthClass +
              "' selected readonly>" +
              response.LengthClass +
              "  (Selected)" +
              "</option>"
          );

          $("#WeightClass").append(
            "<option value='" +
              response.WeightClass +
              "' selected readonly>" +
              response.WeightClass +
              "  (Selected)" +
              "</option>"
          );
          $("#EProduct_DateAv").val(response.Date_avilable);
          $(".EProduct_Length").val(response.Length);
          $(".EProduct_Width").val(response.Width);
          $(".EProduct_height").val(response.Height);
          $("#EProduct_Weight").val(response.Weight);

          // SEO
          $("#EMetaDiscription").val(response.MetaDiscription);
          $("#EMetaKeywords").val(response.MetaKeywords);
          $("#EProductTag").val(response.ProductTag);

          // Additional Images
          $(".EDefaultColor").val(response.DColor);
          $(".EDefaultColorHex").val(response.H_Code);
          $(".EDefaultSize").val(response.DSize);
          $(".EDefaultAmp").val(response.DAmp);

          // Images

          $(".Load_ChangeImage").html(
            ' <div class="col-6">\
          <label>Thumbnail</label>\
          <input type="file" class="dropify" data-height="200" name="image" />\
          </div>\
          <div class="col-6">\
          <label>Add New Image (Multiple)</label>\
          <input type="file" class="dropify" data-height="200" name="InNewImg[]" multiple />\
          </div>'
          );

          for (var i = 0; i <= response.ADDImage.length - 1; i++) {
            // console.log(response.ADDImage[i] + "\n");
            $(".Load_ChangeImage").append(
              '<div class="col-6">\
              <input type="hidden" name="SendImg' +
                i +
                '" value="' +
                response.ADDImageID[i] +
                '">\
                  <label>Existing Image</label>\
                  <input type="file" class="dropify" data-default-file="uploads/Products/' +
                response.ADDImage[i] +
                '" data-height="200" value=' +
                response.ADDImage[i] +
                ' name="Add_Img[]" />\
              </div>'
            );
          }
          // !! Option => Color , Size , Amp
          // var DyNumber = 1;
          var Output = "";
          var OutputSize = "";
          var OutputAmp = "";
          for (var k = 0; k <= response.OptionID.length - 1; k++) {
            // DyNumber++;
            if (response.OptionType[k] == "Color") {
              // console.log(response.OptionType);

              Output +=
                '<div class="col-12 border p-2 mt-2 DyColorArea' +
                response.OptionID[k] +
                '" style="position: relative;">\
                   <i class="mdi mdi-minus-circle text-danger pr-1 RemoveDyColor" data-id="' +
                response.OptionID[k] +
                '" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;z-index:99999"></i>\
                      <div class="row">\
                      <div class="col-6 ">\
                            <label">\
                              Name \
                            </label>\
                            <input type="text" value="' +
                response.OptionName[k] +
                '" name="Color[]" class="form-control">\
                        </div>\
                        <div class="col-6 ">\
                        <label>\
                        Price (+ / -)\
                        </label>\
                        <input type="text" placeholder="" name="Color_Value[]" value="' +
                response.OptionPrice[k] +
                '"  class="form-control">\
                    </div>\
                    <div class="col-6 ">\
                    <label >\
                        Colorcode\
                    </label>\
                    <input type="text" placeholder="" name="ColorCode[]" value="' +
                response.Option_H_Code[k] +
                '" class="form-control ">\
                </div>\
                  </div>\
                </div>';
            }

            // !!Size
            if (response.OptionType[k] == "Size") {
              OutputSize +=
                '<div class="col-12 border p-2 mt-2 DySizeArea' +
                response.OptionID[k] +
                '" style="position: relative;">\
                       <i class="mdi mdi-minus-circle text-danger pr-1 RemoveDySize" data-id="' +
                response.OptionID[k] +
                '" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;z-index:99999"></i>\
                        <div class="row">\
                        <div class="col-6 ">\
                              <label for="Product_Order">\
                                Name \
                              </label>\
                              <input type="text" name="Size[]" value="' +
                response.OptionName[k] +
                '" class="form-control">\
                          </div>\
                          <div class="col-6 ">\
                          <label for="Product_Order">\
                          Price (+ / -)\
                          </label>\
                          <input type="text"  name="Size_Value[]" value="' +
                response.OptionPrice[k] +
                '"  class="form-control">\
                      </div>\
                    </div>\
                  </div>';
            }

            // !!Amp
            if (response.OptionType[k] == "Amp") {
              OutputAmp +=
                '<div class="col-12 border p-2 mt-2 DyAmpArea' +
                response.OptionID[k] +
                '" style="position: relative;">\
                  <i class="mdi mdi-minus-circle text-danger pr-1 RemoveDyAmp" data-id="' +
                response.OptionID[k] +
                '" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;z-index:99999"></i>\
                    <div class="row">\
                    <div class="col-6 ">\
                          <label for="Product_Order">\
                            Name \
                          </label>\
                          <input type="text" name="Amp[]"  value="' +
                response.OptionName[k] +
                '" class="form-control">\
                      </div>\
                      <div class="col-6 ">\
                      <label for="Product_Order">\
                      Price (Total)\
                      </label>\
                      <input type="text"  name="AddDyAmp[]" value="' +
                response.OptionPrice[k] +
                '"  class="form-control autonumber">\
                  </div>\
                  <div class="col-6 ">\
                  <label for="Product_Order">\
                      Quantity\
                  </label>\
                  <input type="text" placeholder="" name="Amp_Quantity[]" value="' +
                response.Option_Quantity[k] +
                '" class="form-control ">\
              </div>\
                </div>\
              </div>';
            }
          } // end for

          if (Output == "" || Output == null) {
            $(".EColor_InputAdmin").html("");
          } else {
            $(".EColor_InputAdmin").html(Output);
          }

          if (OutputAmp == "" || OutputAmp == null) {
            $(".EAmp_InputAdmin").html("");
          } else {
            $(".EAmp_InputAdmin").html(OutputAmp);
          }

          if (OutputSize == "" || OutputSize == null) {
            $(".ESize_InputAdmin").html("");
          } else {
            $(".ESize_InputAdmin").html(OutputSize);
          }

          $(".RemoveDyColor").on("click", function (e) {
            e.preventDefault();
            var CrrNum = $(this).attr("data-id");
            $(".DyColorArea" + CrrNum).remove();
          });

          // !!End Color
          $(".dropify").dropify();
        },
      });
    }
  }
});
// ?? Update
$("#Edit_Product_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("E-PAlerts");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/update/products.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.message);
        RemoveDropify();
        CloseModals("EditProductModal");
      } else if (response.status == "error") {
        DangerAlert(response.message, "E-PAlerts");
      }
      ProductsData();
    },
  });
});
// ?? Delete
$(".Delete_Product_Form").submit(function (e) {
  e.preventDefault();
  // RemoveAlerts("Remove-Manufacturer-Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/delete/product.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("DeleteProductRecord");
        RemoveDropify();
      } else if (response.status == "error") {
        // DangerAlert(response.msg, "Remove-Manufacturer-Alert");
      }
      ProductsData();
    },
  });
});

// !!{{{{{{{{{{{{{{{{{{{{{{{{{{{**************Manufacturers**************}}}}}}}}}}}}}}}}}}}}}}}}}}}
// ?? Insert
$("#Insert_Manufacture_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("Ins_Man_Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/insert/manufacturers.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      console.log(response);
      if (response.status == "success") {
        CloseModals("AddManufacturerModal");
        ResetForm("Insert_Manufacture_Form");
        RemoveDropify();
        ManageTost(response.msg);
      } else if (response.status == "error") {
        DangerAlert(response.msg, "Ins_Man_Alert");
      }
      ManufactureData();
    },
  });
});
// ?? Fetch
ManufactureData();
function ManufactureData() {
  $.ajax({
    url: "back-end/fetch/manufacturers.php",
    method: "GET",
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        Spinner();
        DisDataTabels("datatable-buttons");
        $(".Manufactures_Table_Data").html(response.html);
        DataTabels();
      } else if (response.status == "empty") {
        Spinner();
      }
    },
  });
}

//Getting ID
$(".Manufacture_Table").on("click", function (event) {
  event.preventDefault();
  var $anchor = $(event.target).parent(".CommentIcon");
  var id = $anchor.attr("data-id");
  if (id != "" || id != null) {
    // console.log(id);
    if (id != undefined) {
      $.ajax({
        method: "POST",
        data: { id: id },
        url: "back-end/fetch/manufacturer-id.php",
        success: function (response) {
          response = $.parseJSON(response);
          $(".Cat-ID").val(id);
          if (response.status == "success") {
            $("#Man_Name").val(response.Name);
            $(".hidden-id").val(id);
            $(".Manufacturer-Common-Image").val(response.Img);
          } else if (response.status == "error") {
            $("#Cat_Parent").html(response.html);
          }
        },
      });
    }
  }
});
// ?? Update
$("#Update_Manufacturer_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("Update_Man_Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/update/manufacturers.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("EditCatModal");
        RemoveDropify();
        CloseModals("EditManufactureModal");
      } else if (response.status == "error") {
        DangerAlert(response.msg, "Update_Man_Alert");
      }
      ManufactureData();
    },
  });
});
// ?? Delete
$("#Delete_Manufacturer_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("Remove-Manufacturer-Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/delete/manufacturers.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("DeleteManufactureRecord");
        RemoveDropify();
        CloseModals("DeleteManufactureRecord");
      } else if (response.status == "error") {
        DangerAlert(response.msg, "Remove-Manufacturer-Alert");
      }
      ManufactureData();
    },
  });
});

// !!{{{{{{{{{{{{{{{{{{{{{{{{{{{**************Sales**************}}}}}}}}}}}}}}}}}}}}}}}}}}}
// ?? Insert
$("#Insert_Sales_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("Ins_Sales_Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/insert/Sales.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      console.log(response);
      if (response.status == "success") {
        CloseModals("AddSalesModal");
        ResetForm("Insert_Sales_Form");
        RemoveDropify();
        ManageTost(response.msg);
      } else if (response.status == "error") {
        DangerAlert(response.msg, "Ins_Sales_Alert");
      }
      SalesData();
    },
  });
});
// ?? Fetch
SalesData();
function SalesData() {
  $.ajax({
    url: "back-end/fetch/Sales.php",
    method: "GET",
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        Spinner();
        DisDataTabels("datatable-buttons");
        $(".Sales_Table_Data").html(response.html);
        DataTabels();
      } else if (response.status == "empty") {
        Spinner();
      }
    },
  });
}

//Getting ID
$(".Sales_Table").on("click", function (event) {
  event.preventDefault();
  var $anchor = $(event.target).parent(".CommentIcon");
  var id = $anchor.attr("data-id");
  if (id != "" || id != null) {
    // console.log(id);
    if (id != undefined) {
      $.ajax({
        method: "POST",
        data: { id: id },
        url: "back-end/fetch/Sales-id.php",
        success: function (response) {
          response = $.parseJSON(response);
          $(".Cat-ID").val(id);
          if (response.status == "success") {
            $(".Sales_Edit_Name").val(response.Name);
            $(".ESale_Parent").val(response.Cat_ID);
            // $(".ESale_Products").val(response.Product_ID);
            $(".ESale_Parent").select2().val(response.Cat_ID).trigger("change");
            $(".ESale_Products")
              .select2()
              .val(response.Product_ID)
              .trigger("change");
            $(".SaleType_Switch")
              .select2()
              .val(response.Type)
              .trigger("change");
            $(".EsalesStartDate").val(response.Date_Start);
            $(".EsalesEndDate").val(response.Date_End);
            $(".ESale_Values").val(response.Value);
            $(".Sales-Common-ID").val(id);
          } else if (response.status == "error") {
            $("#Cat_Parent").html(response.html);
          }
        },
      });
    }
  }
});
// ?? Update
$(".Update_Saler_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("Update_Sales_Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/update/Sales.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("EditSaleModal");
      } else if (response.status == "error") {
        DangerAlert(response.msg, "Update_Sales_Alert");
      }
      SalesData();
    },
  });
});

// ?? Delete
$("#Delete_Sales_Form").submit(function (e) {
  e.preventDefault();
  // RemoveAlerts("Remove-Sales-Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/delete/Sales.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("DeleteSaleRecord");
        RemoveDropify();
      } else if (response.status == "error") {
        CloseModals("DeleteSaleRecord");
        ManageTost(response.msg);
      }
      SalesData();
    },
  });
});

// !!{{{{{{{{{{{{{{{{{{{{{{{{{{{**************Shipping Method**************}}}}}}}}}}}}}}}}}}}}}}}}}}}
// ?? Insert
// Empty
// ?? Fetch
ShipMethodData();
function ShipMethodData() {
  $.ajax({
    url: "back-end/fetch/ShipMethod.php",
    method: "GET",
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        Spinner();
        DisDataTabels("datatable-buttons");
        $(".Table_ShipMethod").html(response.html);
        DataTabels();
      } else if (response.status == "empty") {
        Spinner();
      }
    },
  });
}

// $(".SaleType_Switch").change(function () {
//   if ($(".SaleType_Switch").val() === "Alternate") {
//     $(".AddAmount_vis").css("display", "unset");
//   } else {
//     $(".AddAmount_vis").css("display", "none");
//   }
// });

//Getting ID
$(".Ship_Table").on("click", function (event) {
  event.preventDefault();
  var $anchor = $(event.target).parent(".CommentIcon");
  var id = $anchor.attr("data-id");
  if (id != "" || id != null) {
    // console.log(id);
    if (id != undefined) {
      $.ajax({
        method: "POST",
        data: { id: id },
        url: "back-end/fetch/ShipMethod-id.php",
        success: function (response) {
          response = $.parseJSON(response);
          // console.log(response);
          if (response.status == "success") {
            $(".ShipOptionType").val(response.Type);
            $(".ShipOptionid").val(id);
            if (response.Type == "FLAT") {
              $(".TableRatePanel").css("display", "none");
              $(".FlatRatePanel").css("display", "unset");
              //
              $(".FlateRateFeild").val(response.Rate);
            } else if (response.Type == "TABLE_RATE") {
              $(".FlatRatePanel").css("display", "none");
              $(".TableRatePanel").css("display", "unset");
              //
              $(".TableSaleFeild").val(response.Sale_tax);
              $(".TableFuleFeild").val(response.Fuel_tax);
              $(".TableRateFeild").val(response.Rate);
            }
          }
        },
      });
    }
  }
});
// ?? Update
$("#UpdateRateData").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("ShipUpdtae_Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/update/ShipMethod.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("EditShipModal");
      } else if (response.status == "error") {
        DangerAlert(response.msg, "ShipUpdtae_Alert");
      }
      ShipMethodData();
    },
  });
});
// ?? Delete
$("#Delete_Sales_Form").submit(function (e) {
  e.preventDefault();
  RemoveAlerts("Remove-Sales-Alert");
  $.ajax({
    method: "POST",
    data: new FormData(this),
    url: "back-end/delete/Sales.php",
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        ManageTost(response.msg);
        CloseModals("DeleteSalesRecord");
        RemoveDropify();
        CloseModals("DeleteSalesRecord");
      } else if (response.status == "error") {
        DangerAlert(response.msg, "Remove-Sales-Alert");
      }
      ShipMethodData();
    },
  });
});

// ??{{THEME SECTION START}}

// **Slider Record--------------------------------------------------------------------------------

Slider_Data();
$("#Insert_Slider_Form").submit(function (e) {
  var id = "Insert-Slider-Alert";
  RemoveAlerts(id);
  e.preventDefault();
  $.ajax({
    url: "back-end/insert/Slider.php",
    method: "post",
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        SuccessAlert(response.message, id);
        CloseModals("AddSliderRecord");
      } else if (response.status == "error") {
        DangerAlert(response.message, id);
      }
      Slider_Data();
      // Slider_Data();
      // ScrollModal();
    },
  });
});
//

function Slider_Data() {
  $.ajax({
    method: "get",
    url: "back-end/fetch/slider.php",
    success(response) {
      response = $.parseJSON(response);
      Spinner();
      DisDataTabels("datatable-buttons");
      $("#Slider-Table-Data").html(response.html);
      DataTabels();
    },
  });
}

//Getting ID
$(function () {
  $(".Slider-Table").on("click", function (event) {
    event.preventDefault();
    var $anchor = $(event.target).parent(".CommentIcon");
    var id = $anchor.attr("data-id");
    //        console.log(id);
    if (id != "" && id != undefined) {
      $.ajax({
        url: "back-end/fetch/slider-id.php",
        data: { id: id },
        method: "post",
        success: function (response) {
          response = $.parseJSON(response);
          $(".Slider-Common-ID").val(id);
          $("#ESlider_Title").val(response.Title);
          $("#ESlider_Detail").val(response.Detail);
          $("#ESlider_Link").val(response.Link);
          $("#ESlider_Alt").val(response.Alt);
          $(".Slider-Common-Image").val(response.Image);
        },
      });
    }
  });
});

//--01) Edit Slider Record (Start)

$(function () {
  $("#Edit_Slider_Form").submit(function (e) {
    var id = "Edit-Slider-Alert";
    RemoveAlerts(id);
    e.preventDefault();
    $.ajax({
      url: "back-end/update/Slider.php",
      method: "post",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          SuccessAlert(response.message, id);
          CloseModals("EditSliderRecord");
        } else if (response.status == "error") {
          DangerAlert(response.message, id);
        }
        Slider_Data();
        // ScrollModal();
      },
    });
  });
});

//--01) Edit Slider Record (End)

//--01) Delete Slider Record (Start)

$(function () {
  $("#Delete_Slider_Form").submit(function (e) {
    id = "Slider-Delete-Alert";
    RemoveAlerts(id);
    e.preventDefault();
    $.ajax({
      url: "back-end/delete/slider.php",
      method: "post",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          SuccessAlert(response.message, id);
          CloseModals("DeleteSliderRecord");
        } else if (response.status == "error") {
          DangerAlert(response.message, id);
          CloseModals("DeleteSliderRecord");
        }

        Slider_Data();
      },
    });
  });
});

//--01) Edit Slider Record (End)

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!Ads!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
Ads_Data();
function Ads_Data() {
  $.ajax({
    method: "get",
    url: "back-end/fetch/ads.php",
    success(response) {
      response = $.parseJSON(response);
      // console.log(response);
      Spinner();
      DisDataTabels("datatable-buttons");
      $("#Ads-Table-Data").html(response.html);
      DataTabels();
    },
  });
}

//Getting ID
$(function () {
  $(".Ads-Table").on("click", function (event) {
    event.preventDefault();
    var $anchor = $(event.target).parent(".CommentIcon");
    var id = $anchor.attr("data-id");
    //        console.log(id);
    if (id != "" && id != undefined) {
      $.ajax({
        url: "back-end/fetch/ads-id.php",
        data: { id: id },
        method: "post",
        success: function (response) {
          response = $.parseJSON(response);
          $(".Ads-Common-ID").val(id);
          $("#EAds_Title").val(response.Name);
          $("#EAds_Link").val(response.Link);
          $(".AdsHiddenImage").val(response.Image);
          if (response.Status == "True") {
            alert("true");
            $(".AdSwitchStatus").prop("checked", false);
          } else {
            alert("false");
            $(".AdSwitchStatus").prop("checked", false);
          }
        },
      });
    }
  });
});

$("#Edit_Ads_Form").submit(function (e) {
  var id = "Edit-Ads-Alert";
  RemoveAlerts(id);
  e.preventDefault();
  $.ajax({
    url: "back-end/update/Ads.php",
    method: "post",
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        SuccessAlert(response.message, id);
        CloseModal();
      } else if (response.status == "error") {
        DangerAlert(response.message, id);
      }
      Ads_Data(); // Slider_Data();
      // ScrollModal();
    },
  });
});

// **Banner--------------------------------------------------------------------------------

Banner_Data();
// alert("a");
$(".Insert_Banner_Form").submit(function (e) {
  var id = "Insert-Banner-Alert";
  // alert("Aa");
  RemoveAlerts(id);
  e.preventDefault();
  $.ajax({
    url: "back-end/insert/main-banner.php",
    method: "post",
    data: new FormData(this),
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      response = $.parseJSON(response);
      if (response.status == "success") {
        SuccessAlert(response.message, id);
        CloseModals("AddBannerRecord");
      } else if (response.status == "error") {
        DangerAlert(response.message, id);
      }
      Banner_Data();
    },
  });
});
//

function Banner_Data() {
  $.ajax({
    method: "get",
    url: "back-end/fetch/main-banner.php",
    success(response) {
      response = $.parseJSON(response);
      Spinner();
      DisDataTabels("datatable-buttons");
      $("#Banner-Table-Data").html(response.html);
      DataTabels();
    },
  });
}

//Getting ID
$(function () {
  $(".Banner-Table").on("click", function (event) {
    event.preventDefault();
    var $anchor = $(event.target).parent(".CommentIcon");
    var id = $anchor.attr("data-id");
    //        console.log(id);
    if (id != "" && id != undefined) {
      $.ajax({
        url: "back-end/fetch/main-vbnner-id.php",
        data: { id: id },
        method: "post",
        success: function (response) {
          response = $.parseJSON(response);
          $(".Banner-Common-ID").val(id);
          // $("Banner-Common-Image").addClass("dropify");
          // $(".Banner-Common-Image").attr("data-height", 300);
          // $(".Banner-Common-Image").attr(
          //   "data-default-file",
          //   "uploads/banner/" + response.Image
          // );
          // $(".dropify").dropify();
          $(".Banner-Common-Image").val(response.Image);
        },
      });
    }
  });
});

//--01) Edit Banner Record (Start)

$(function () {
  $("#Edit_Banner_Form").submit(function (e) {
    var id = "Edit-Banner-Alert";
    RemoveAlerts(id);
    e.preventDefault();
    $.ajax({
      url: "back-end/update/main-banner.php",
      method: "post",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          SuccessAlert(response.message, id);
          CloseModals("EditBannerRecord");
        } else if (response.status == "error") {
          DangerAlert(response.message, id);
        }
        Banner_Data();
        // ScrollModal();
      },
    });
  });
});

//--01) Edit Banner Record (End)

//--01) Delete Banner Record (Start)

$(function () {
  $("#Delete_Banner_Form").submit(function (e) {
    id = "Banner-Delete-Alert";
    RemoveAlerts(id);
    e.preventDefault();
    $.ajax({
      url: "back-end/delete/main-banner.php",
      method: "post",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          SuccessAlert(response.message, id);
          CloseModals("DeleteBannerRecord");
        } else if (response.status == "error") {
          DangerAlert(response.message, id);
          CloseModals("DeleteBannerRecord");
        }

        Banner_Data();
      },
    });
  });
});

//--01) Edit Banner Record (End)

// ??{{THEME SECTION END}}

// !!User Section Start

// *Fetch User Account*
UserAccount_Data();
function UserAccount_Data() {
  $.ajax({
    method: "get",
    url: "back-end/fetch/user-accounts.php",
    success(response) {
      response = $.parseJSON(response);
      // console.log(response);
      Spinner();
      DisDataTabels("datatable-buttons");
      $(".User_Table_Data").html(response.html);
      DataTabels();

      // DataTabels();
    },
  });
}

//Getting ID
$(function () {
  $(".User_Table").on("click", function (event) {
    event.preventDefault();
    var $anchor = $(event.target).parent(".CommentIcon");
    var id = $anchor.attr("data-id");
    if (id != "" && id != undefined) {
      $.ajax({
        url: "back-end/fetch/UserAccount-id.php",
        data: { id: id },
        method: "post",
        success: function (response) {
          response = $.parseJSON(response);
          $(".user-hidden-id").val(id);
          // console.log(id);
          $(".user-hidden-status").val(response.User_Status);
        },
      });
    }
  });
});

//--01) Edit User Record (Start)

$(function () {
  $(".Delete_User_Form").submit(function (e) {
    var id = "UserAccount-Alert";
    RemoveAlerts(id);
    e.preventDefault();
    $.ajax({
      url: "back-end/update/user-account.php",
      method: "post",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          // SuccessAlert(response.msg, id);
          Spinner();
          DisDataTabels("datatable-buttons");
          UserAccount_Data();
          DataTabels();
          CloseModals("BlockUserRecord");
        } else if (response.status == "error") {
          DangerAlert(response.msg, id);
        }
      },
    });
  });
});

// !!User Section End

/*
//*!*!*!*!*!*!*!**!*!*!*!!**!*!*!*!*!*!**!*Order Section Start*!*!!**!!*!*!*!*!*!**!*!*!*!!**!*!*!*!*!*!*
*/

// *Fetch Order Data*
Order_Data();
function Order_Data() {
  $.ajax({
    method: "get",
    url: "back-end/fetch/Order.php",
    success(response) {
      response = $.parseJSON(response);
      Spinner();
      DisDataTabels("datatable-buttons");
      $("#Order-Table-Data").html(response.html);
      DataTabels();

      // DataTabels();
    },
  });
}

//Getting ID
$(function () {
  $(".Order-Table").on("click", function (event) {
    // event.preventDefault();
    var $anchor = $(event.target).parent(".CommentIcon");
    var id = $anchor.attr("data-id");
    if (id != "" && id != undefined) {
      $.ajax({
        url: "back-end/fetch/Order-id.php",
        data: { id: id },
        method: "post",
        success: function (response) {
          // alert(id);
          response = $.parseJSON(response);
          console.log(response);
          // $(".user-hidden-id").val(id);
          var ProductDetailv = response.Product_Detail;
          var NewProdDetail = ProductDetailv.split(",");
          // console.log(NewProdDetail.length);
          var index = 0;
          for (ab = 0; ab < NewProdDetail.length; ab++) {
            index = ab + 1;
            $(".VOrderPName").append(
              "(" + index + ") " + NewProdDetail[ab] + "<br>"
            );
          }
          $(".VOrderNo").html(response.Order_ID);

          // $(".CorderNumber").val(response.Order_ID);
          $(".VOrderToal").html(response.Sub_Total);
          $(".VOrderPprice").html(response.Product_price);
          $(".VOrderPquantity").html(response.Quantity);
          $(".VOrderCname").html(response.Name);
          $(".VOrderCEmail").html(
            '<a href="mailto:' + response.Email + '">' + response.Email + "</a>"
          );
          $(".VOrderCPhone").html(
            '<a href="tel:' + response.Number + '">' + response.Number + "</a>"
          );
          $(".VOrderCCity").html(response.City);
          $(".VOrderCAdd").html(response.Address);
          $(".VOrderPPcode").html(response.Postal_Code);
          $(".VOrderSMethod").html(response.Shipping_Method);
          $(".VOrderSSPrice").html(response.Shipping_Price);
        },
      });
    }
  });

  $(".Order-Table").on("click", function (event) {
    // event.preventDefault();
    var $anchor = $(event.target).parent(".CommentIconA");
    var id = $anchor.attr("data-id");
    var Oid = $anchor.attr("data-orderid");
    var Ostatus = $anchor.attr("data-status");
    // alert(Ostatus);
    if (id != "" && id != undefined) {
      $(".CorderNumber").val(Oid);
      $(".user-hidden-id").val(id);
    }

    $(".OrderCrrStatus").select2().val(Ostatus).trigger("change");
  });

  // $(".Order-Table").on("click", function (event) {
  //   // event.preventDefault();
  //   var $anchor = $(event.target).parent(".CommentIconA");
  //   var id = $anchor.attr("data-id");
  //   if (id != "" && id != undefined) {
  //     $.ajax({
  //       url: "back-end/fetch/Order-id.php",
  //       data: { id: id },
  //       method: "post",
  //       success: function (response) {
  //         alert(id);
  //         response = $.parseJSON(response);
  //         console.log(response);
  //         $(".CorderNumber").val(response.Order_ID);
  //       },
  //     });
  //   }
  // });
});

// shipped
$(".OrderCrrStatus").change(function () {
  if ($(".OrderCrrStatus").val() == "Shipped") {
    $(".ShowShipOpt").css("display", "unset");
  } else {
    $(".ShowShipOpt").css("display", "none");
  }
});

$(function () {
  $(".ChangeOrderFormm").submit(function (e) {
    var id = "UserAccount-Alert";
    RemoveAlerts(id);
    e.preventDefault();
    $.ajax({
      url: "back-end/update/Order-Status.php",
      method: "post",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          // SuccessAlert(response.msg, id);
          Spinner();
          DisDataTabels("datatable-buttons");
          Order_Data();
          DataTabels();
          CloseModals("EditOrderModal");
        } else if (response.status == "error") {
          DangerAlert(response.msg, id);
        }
      },
    });
  });
});

$(function () {
  $(".ShipPaidStatusForm").submit(function (e) {
    var id = "UserAccount-Alert";
    RemoveAlerts(id);
    e.preventDefault();
    $.ajax({
      url: "back-end/update/Order-PaidStatus.php",
      method: "post",
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {
        response = $.parseJSON(response);
        if (response.status == "success") {
          // SuccessAlert(response.msg, id);
          Spinner();
          DisDataTabels("datatable-buttons");
          Order_Data();
          DataTabels();
          CloseModals("ChangeShipPaidStatus");
        } else if (response.status == "error") {
          DangerAlert(response.msg, id);
        }
      },
    });
  });
});
/*
!!!!!!*!*!*!*!*!*!**!*!*!*!!**!*!*!*!*!*!**!*Order Section ENd*!*!!**!!*!*!*!*!*!**!*!*!*!!**!*!*!*!*!*!*
*/

// !Site Review
siteReview();
function siteReview() {
  RemoveAlerts("ShowCommentAlert");
  $.ajax({
    method: "get",
    url: "back-end/fetch/site-reviews.php",
    success(response) {
      response = $.parseJSON(response);
      $("#Comment_Table_body").html(response.html);

      $(".ChangeCommentStatus").on("change", function (event) {
        if ($(this).prop("checked") == true) {
          // alert($(this).prop("checked"));
          var $anchor = $(event.target).parent(".switch");
          var id = $anchor.attr("data-id");
          Check_status = "True";
          $.ajax({
            method: "post",
            url: "back-end/update/SiteReview_Status.php",
            data: { Check_status: 1, id: id },
            success: function (response) {
              response = $.parseJSON(response);
              console.log(response);
              if (response.status == "error") {
                DangerAlert(response.msg, "ShowCommentAlert");
              } else {
                ManageTost("Review Visible");
              }
            },
          });
        } else {
          // alert($(this).prop("checked"));

          var $anchor = $(event.target).parent(".switch");
          var id = $anchor.attr("data-id");
          $.ajax({
            method: "post",
            url: "back-end/update/SiteReview_Status.php",
            data: { Check_status: 0, id: id },
            success: function (response) {
              response = $.parseJSON(response);
              console.log(response);
              if (response.status == "error") {
                DangerAlert(response.msg, "ShowCommentAlert");
              } else {
                ManageTost("Review Hidden");
              }
            },
          });
        }
      });
    },
  });
}

// !!__Dashbord

$(function () {
  "use strict";
  $.ajax({
    url: "back-end/dashbord/PerPageViews.php",
    method: "POST",
    success: function (data) {
      data = $.parseJSON(data);
      console.log(data.msg);
      $("#morris-bar-example").length &&
        Morris.Donut({
          element: "morris-bar-example",
          data: data.msg,
        });
    },
  });
}),
  $(document).ready(function () {
    var o,
      i = function () {
        $.ajax({
          url: "back-end/dashbord/ResentOrder.php",
          method: "POST",
          success: function (data) {
            data = $.parseJSON(data);
            // console.log(data.msg);
            $("#sparkline1").sparkline(data.msg, {
              type: "bar",
              width: "100%",
              height: "80",
              barColor: "#9e091c",
              negBarColor: "#9e091c",
            });
          },
        });

        $.ajax({
          url: "back-end/dashbord/TotalOrder.php",
          method: "POST",
          success: function (data) {
            data = $.parseJSON(data);
            // console.log(data.msg);
            $("#sparkline2").sparkline(data.msg, {
              type: "line",
              width: "100%",
              height: "80",
              chartRangeMax: 35,
              lineColor: "#f1c31c",
              fillColor: "rgba(241, 195, 28, 0.3)",
              highlightLineColor: "rgba(0,0,0,.1)",
              highlightSpotColor: "rgba(0,0,0,.2)",
              maxSpotColor: !1,
              minSpotColor: !1,
              spotColor: !1,
              lineWidth: 1,
            });
          },
        });

        $.ajax({
          url: "back-end/dashbord/TotalCustomer.php",
          method: "POST",
          success: function (data) {
            data = $.parseJSON(data);
            // console.log(data.msg);
            $("#sparkline3").sparkline(data.msg, {
              type: "line",
              width: "100%",
              height: "80",
              chartRangeMax: 35,
              lineColor: "#ff5b5b",
              fillColor: "rgba(255, 91, 91, 0.3)",
              highlightLineColor: "rgba(0,0,0,.1)",
              highlightSpotColor: "rgba(0,0,0,.2)",
              maxSpotColor: !1,
              minSpotColor: !1,
              spotColor: !1,
              lineWidth: 1,
            });
          },
        });

        $.ajax({
          url: "back-end/dashbord/TotalUser.php",
          method: "POST",
          success: function (data) {
            data = $.parseJSON(data);
            // console.log(data.msg);
            $("#sparkline4").sparkline(data.msg, {
              type: "line",
              width: "100%",
              height: "80",
              chartRangeMax: 35,
              lineColor: "#1a213b",
              fillColor: "rgba(67, 75, 107, 0.3)",
              highlightLineColor: "rgba(0,0,0,.1)",
              highlightSpotColor: "rgba(0,0,0,.2)",
              maxSpotColor: !1,
              minSpotColor: !1,
              spotColor: !1,
              lineWidth: 1,
            });
          },
        });
      };
    i(),
      $(window).resize(function (l) {
        clearTimeout(o),
          (o = setTimeout(function () {
            i();
          }, 300));
      });
  }),
  // $(function () {
  //   $('[data-plugin="knob"]').knob();
  // });

  $(function () {
    $('[data-plugin="knob"]').knob({
      change: function (v) {
        console.log(v);
      },
      draw: function () {
        $(this.i).val(this.cv + "%");
      },
    });
  });

// !!__Dashbord END

// !!!! --- !!!!!:::::""""~~FUnCtIonS~~** --- !!!!!:::::""""
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

// Dark Mode
function addDarkmodeWidget() {
  const options = {
    mixColor: "#fff", // default: '#fff'
    backgroundColor: "#fff", // default: '#fff'
    buttonColorDark: "#444", // default: '#100f2c'
    buttonColorLight: "#fff", // default: '#fff'
    label: "🌓", // default: ''
    autoMatchOsTheme: true, // default: true
  };

  const darkmode = new Darkmode(options);
  darkmode.showWidget();
}

window.addEventListener("load", addDarkmodeWidget);
