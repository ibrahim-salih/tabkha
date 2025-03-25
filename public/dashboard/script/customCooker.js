$(document).ready(function () {
    $("#country").on("change", function () {
        var countryId = this.value;
        $("#state").html("");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            // url: '{{ route("dashboard.lowyers.getStates") }}?country=' + countryId,
            url: "/cooker/getStates",
            data: {
                country: countryId,
            },
            type: "get",
            success: function (res) {
                // return res;
                $("#state").html('<option value=""> المدينة</option>');
                $.each(res, function (key, value) {
                    $("#state").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    });
    // get categories
    $("#Xsection").on("change", function () {
        var categoryId = this.value;
        $("#Xcategory").html("");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            // url: '{{ route("dashboard.lowyers.getStates") }}?country=' + countryId,
            url: "/cooker/menus/getCats",
            data: {
                category: categoryId,
            },
            type: "get",
            success: function (res) {
                // return res;
                $("#Xcategory").html('<option value=""> الفئة</option>');
                $.each(res, function (key, value) {
                    $("#Xcategory").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    });
    // get foods
    $("#Xcategory").on("change", function () {
        var foodId = this.value;
        $("#food").html("");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            // url: '{{ route("dashboard.lowyers.getStates") }}?country=' + countryId,
            url: "/cooker/menus/getFoods",
            data: {
                food: foodId,
            },
            type: "get",
            success: function (res) {
                // return res;
                $("#food").html('<option value=""> الطبخة</option>');
                $.each(res, function (key, value) {
                    $("#food").append(
                        '<option value="' +
                            value.id +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    });
    // Menu status
    $('input[name="toogleMenu"]').change(function (){
        var mode=$(this).prop('checked');
        var id=$(this).val();
        // alert(mode);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            url: '/cooker/menus/status',
            data:{
                mode:mode,
                id:id,
            },
            success:function(response){
                if(response.status){
                    // alert(response.msg);
                    toastr.success(response.msg,'الحالة');
                    if (response['active'] == 0) {
                        // $("#section-" + section_id).html("<i class='ft-square' status='Inactive'></i>");
                    } else if (response['active'] == 1) {
                        // $("#section-" + section_id).html("<i class='ft-check-square' status='Active'></i>");
                    }
                }else{
                    // alert('Please try agin.');
                    toastr.error('Please try agin.','Error');
                }
            }
        })
    });


    $(document).on("click", ".updateCountryStatus", function () {
        //  alert ('ok'); die;
        var status = $(this).children("i").attr("status");
        var country_id = $(this).attr("country_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            url: '/dashboard/countries/update-country-status',
            data: {status: status, country_id: country_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#country-" + country_id).html("<i class='ft-square' status='Inactive'></i>");
                    toastr.error('country is','Inactive');
                } else if (resp['status'] == 1) {
                    $("#country-" + country_id).html("<i class='ft-check-square' status='Active'></i>");
                    toastr.success('country is','Active');
                }
                
                // Swal.fire({
                //     position: 'top-center',
                //     icon: 'success',
                //     title: ''+resp.message+'',
                //     showConfirmButton: false,
                //     timer: 1500
                // })
                
            }, error: function () {
                // alert('Error');
            }
        })
    });
    
    //check admin password is correct or not
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        //alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/cooker/check-password',
            data: {current_password: current_password},
            success: function (resp) {
                //alert(resp);
                if (resp == "false") {
                    $("#check_password").html("<font color='red'>كلمة المرور الحالية غير صحيحة</font>");
                } else if (resp == "true") {
                    $("#check_password").html("<font color='green'>كلمة المرور الحالية صحيحة</font>");
                }
               
            }, error: function () {
                alert('Error');
            }
        });
    })
    //end check admin password is correct or not
    //update admin status
    $(document).on("click", ".UpdateAdminStatus", function () {
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-admin-status',
            data: {status: status, admin_id: admin_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#admin-" + admin_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#admin-" + admin_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update section status
    $(document).on("click", ".UpdateSectionStatus", function () {
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/sections/update-section-status',
            data: {status: status, section_id: section_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    //old
                    // <i class='ft-square' status='Inactive'></i>
                    //new
                    // <div class='row skin skin-square'><input type='checkbox' id='input-12' status='Inactive' checked></div>
                    $("#section-" + section_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#section-" + section_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update category status
    // $('.switchBootstrap').click(function (event) {
    //     if (this.checked) {
    //         $('.checkbox1').each(function () {
    //             //this.checked = true;
    //             alert('checked');
    //         });
    //     } else {
    //         $('.checkbox1').each(function () {
    //             //this.checked = false;
    //             alert('unchecked');
    //         });
    //     }
    // });
    $(".CatActive").on('change', function() {
        alert("checked");
        //var CatActive = $("#CatActive").val();
    });
     $(document).on("click", ".UpdateCategoryStatus", function () {
         var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/categories/update-category-status',
            data: {status: status, category_id: category_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#category-" + category_id).html("<i class='ft-square' status='Inactive'></i>");
                    //$("#category-" + category_id).html("<input class='switchBootstrap' id='switchBootstrap18' data-on-color='danger' data-off-color='danger' />");
                } else if (resp['status'] == 1) {
                    $("#category-" + category_id).html("<i class='ft-check-square' status='Active'></i>");
                    //$("#category-" + category_id).html("<input class='switchBootstrap' id='switchBootstrap18' data-on-color='success' data-off-color='danger' checked />");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update brand status
    $(document).on("click", ".UpdateBrandStatus", function () {
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/brands/update-brand-status',
            data: {status: status, brand_id: brand_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#brand-" + brand_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#brand-" + brand_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update Product status
    $(document).on("click", ".UpdateProductStatus", function () {
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        // alert(product_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/products/update-product-status',
            data: {status: status, product_id: product_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#product-" + product_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#product-" + product_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update Attribute status
    $(document).on("click", ".UpdateAttributeStatus", function () {
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/products/update-attribute-status',
            data: {status: status, attribute_id: attribute_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#attribute-" + attribute_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#attribute-" + attribute_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update Image status
    $(document).on("click", ".UpdateImageStatus", function () {
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/products/update-image-status',
            data: {status: status, image_id: image_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#image-" + image_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#image-" + image_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update Banner status
    $(document).on("click", ".UpdateBannerStatus", function () {
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/banners/update-banner-status',
            data: {status: status, banner_id: banner_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#banner-" + banner_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#banner-" + banner_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update Coupon status
    $(document).on("click", ".updateCouponStatus", function () {
        var status = $(this).children("i").attr("status");
        var coupon_id = $(this).attr("coupon_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/coupons/update-coupon-status',
            data: {status: status, coupon_id: coupon_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#coupon-" + coupon_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#coupon-" + coupon_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update currencies status
    $(document).on("click", ".updateCurrencyStatus", function () {
        var status = $(this).children("i").attr("status");
        var currency_id = $(this).attr("currency_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/currencies/update-currency-status',
            data: {status: status, currency_id: currency_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#currency-" + currency_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#currency-" + currency_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update shipping status
    $(document).on("click", ".updateShippingStatus", function () {
        var status = $(this).children("i").attr("status");
        var shipping_id = $(this).attr("shipping_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/shipping/update-shipping-status',
            data: {status: status, shipping_id: shipping_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#shipping-" + shipping_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#shipping-" + shipping_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update Countries status
    $(document).on("click", ".updateCountryStatus2", function () {
        var status = $(this).children("i").attr("status");
        var country_id = $(this).attr("country_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/countries/update-country-status',
            data: {status: status, country_id: country_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#country-" + country_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#country-" + country_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update Pages status
    $(document).on("click", ".updatePageStatus", function () {
        var status = $(this).children("i").attr("status");
        var page_id = $(this).attr("page_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/cms-pages/update-page-status',
            data: {status: status, page_id: page_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#page-" + page_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#page-" + page_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update filter status
    $(document).on("click", ".updateFilterStatus", function () {
        var status = $(this).children("i").attr("status");
        var filter_id = $(this).attr("filter_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/filters/update-filter-status',
            data: {status: status, filter_id: filter_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#filter-" + filter_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#filter-" + filter_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update filter value status
    $(document).on("click", ".updateFilterValueStatus", function () {
        var status = $(this).children("i").attr("status");
        var filter_id = $(this).attr("filter_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/filters/update-filter-value-status',
            data: {status: status, filter_id: filter_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#filter-" + filter_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#filter-" + filter_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //update Rating status
    $(document).on("click", ".updateRatingStatus", function () {
        var status = $(this).children("i").attr("status");
        var rating_id = $(this).attr("rating_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-rating-status',
            data: {status: status, rating_id: rating_id},
            success: function (resp) {
                //alert(resp);
                if (resp['status'] == 0) {
                    $("#rating-" + rating_id).html("<i class='ft-square' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#rating-" + rating_id).html("<i class='ft-check-square' status='Active'></i>");
                }
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: ''+resp.message+'',
                    showConfirmButton: false,
                    timer: 1500
                })
            }, error: function () {
                alert('Error');
            }
        })
    });
    //confirm delete
    // $(".confirmDelete").click(function () {
    //     var title = $(this).attr("title");
    //     if(confirm("are you sure to delete "+title+"?")){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // })
    //$(".confirmDelete").click(function () {
    $(document).on("click", ".confirmDelete", function () {
        var sec = $(this).attr("sec");
        var module = $(this).attr("module");
        var moduleid = $(this).attr("moduleid");
        // alert(module);
        Swal.fire({
            title: 'هل أنت واثق؟',
            text: "لن تتمكن من التراجع عن هذا!",
            icon: 'تحذير',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'الغاء',
            confirmButtonText: 'نعم ، احذف!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Swal.fire(
                //     'تم الحذف!',
                //     'تم حذف ملفك.',
                //     'النجاح'
                // )
                window.location = "/admin/" + sec +"/delete-" + module + "/" + moduleid;
                // window.location = "/admin/" + sec +"/delete/" + moduleid;
            }
        })
    })
    //append categories
    $("#section_id").change(function () {
        var section_id = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '/admin/append-categories-level',
            data: {section_id: section_id},
            success: function (resp) {
                //alert(resp);
                // if (resp['status'] == 0) {
                $("#appendCategoriesLevel").html(resp);
                // } else if (resp['status'] == 1) {
                //     $("#category-" + category_id).html("<i class='ft-check-square' status='Active'></i>");
                // }
            }, error: function () {
                alert('Error');
            }
        })
    });
    // show/hide coupon field for manual/automatic
    $("#ManualCoupon").click(function () {
        $("#couponField").show();

    });
    $("#AutomaticCoupon").click(function () {
        $("#couponField").hide();

    });
    //products attribute add/remove
    // $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><div style="height: 10px"></div><input type="text" name="size[]" placeholder="الحجم " required="" value="" style="width: 100px;"/>&nbsp;<input type="text" name="sku[]" placeholder="sku" required="" value="" style="width: 100px;"/>&nbsp;<input type="text" name="price[]" placeholder="السعر" required="" value="" style="width: 80px;"/>&nbsp;<input type="text" name="stock[]" placeholder="الكمية" required="" value="" style="width: 80px;" /><a href="javascript:void(0);" class="remove_button sort btn btn-danger btn-round"><i class="ft-x"></i>حذف</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });



    //show filters on selection of category
    $("#category_id").on('change', function () {
        var category_id = $(this).val();
        var product_id = $('#id').val();
        // alert(product_id); die();
        if(product_id == null || product_id == '' || product_id == undefined)
            {
                // alert('no id'); die();
                // alert(product_id); die();
                $url = '/admin/category_filtersAdd';
            }else{
                // alert('no 1'); die();
                $url = '/admin/category_filters';
            }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: $url,
            data: {category_id: category_id,product_id: product_id},
            success: function (resp) {
                // alert(resp.view);
                // if (resp['status'] == 0) {
                $(".loadFilters").html(resp.view);
                // } else if (resp['status'] == 1) {
                //     $("#category-" + category_id).html("<i class='ft-check-square' status='Active'></i>");
                // }
            }, error: function () {
                alert('Error');
            }
        });
    });


    // Work status
    $('input[name="toogleWork"]').change(function (){
        var mode=$(this).prop('checked');
        var id=$(this).val();
        // alert(mode);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            url: '/cooker/work',
            data:{
                mode:mode,
                id:id,
            },
            success:function(response){
                if(response.status){
                    // alert(response.msg);
                    toastr.success(response.msg,'الحالة');
                    if (response['active'] == 0) {
                        // $("#section-" + section_id).html("<i class='ft-square' status='Inactive'></i>");
                    } else if (response['active'] == 1) {
                        // $("#section-" + section_id).html("<i class='ft-check-square' status='Active'></i>");
                    }
                }else{
                    // alert('Please try agin.');
                    toastr.error('Please try agin.','Error');
                }
            }
        })
    });
    // Pre status
    $('input[name="tooglePre"]').change(function (){
        var mode=$(this).prop('checked');
        var id=$(this).val();
        // alert(mode);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            url: '/cooker/prePay',
            data:{
                mode:mode,
                id:id,
            },
            success:function(response){
                if(response.status){
                    // alert(response.msg);
                    toastr.success(response.msg,'الحالة');
                    if (response['active'] == 0) {
                        // $("#section-" + section_id).html("<i class='ft-square' status='Inactive'></i>");
                    } else if (response['active'] == 1) {
                        // $("#section-" + section_id).html("<i class='ft-check-square' status='Active'></i>");
                    }
                }else{
                    // alert('Please try agin.');
                    toastr.error('Please try agin.','Error');
                }
            }
        })
    });
    // COD status
    $('input[name="toogleCod"]').change(function (){
        var mode=$(this).prop('checked');
        var id=$(this).val();
        // alert(mode);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            type: 'POST',
            url: '/cooker/codPay',
            data:{
                mode:mode,
                id:id,
            },
            success:function(response){
                if(response.status){
                    // alert(response.msg);
                    toastr.success(response.msg,'الحالة');
                    if (response['active'] == 0) {
                        // $("#section-" + section_id).html("<i class='ft-square' status='Inactive'></i>");
                    } else if (response['active'] == 1) {
                        // $("#section-" + section_id).html("<i class='ft-check-square' status='Active'></i>");
                    }
                }else{
                    // alert('Please try agin.');
                    toastr.error('Please try agin.','Error');
                }
            }
        })
    });
    //////////ENDS///////////////////
});
