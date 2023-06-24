// const { isEmpty } = require("lodash");


function token() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
};
$(document).ready(function () {

    $(document).on('submit', '#add_products', function (e) {
        e.preventDefault();
        token();
        let formData = new FormData(jQuery('#add_products')[0]);

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            // dataType: 'json',

            success: function (data) {
                if (data.status === 200) {
                    $("#name-error").hide();
                    $("#files-error").hide();
                    Swal.fire({
                        title: "Success",
                        type: "success",
                        text: data.success,
                        // 
                        confirmButtonText: "OK"
                    });
                } else if (data.status === 400) {
                    var errors = data.errors;
                    $.each(errors, function (field, message) {
                        if (field === 'name') {
                            $("#name-error").text(message);
                            $("#name-error").show();
                        } else if (field === 'files') {
                            $("#files-error").text(message);
                            $("#files-error").show();
                        }
                    });
                    Swal.fire({
                        title: "Error",
                        type: "error",
                        text: Object.values(data.errors).join(" & "),
                        // 
                        confirmButtonText: "OK"
                    });
                }
                else {
                    Swal.fire({
                        title: "Error",
                        type: "error",
                        text: 'Unknown error, please try again',

                        confirmButtonText: "OK"
                    });
                }
            }
        })
    })
})

$(document).ready(function () {
    $('#formAddCart').submit(function (event) {
        token();
        event.preventDefault(); // ngăn chặn form submit mặc định
        var url = $(this).attr('action'); // lấy url từ thuộc tính action của form
        var data = $(this).serialize(); // chuyển các trường của form thành chuỗi query string
        Swal.fire({
            title: 'Thêm vào giỏ hàng',
            text: "Bạn muốn thêm tài khoản này vào giỏ hàng ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Thêm ngay'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function (data) {
                        if (data.status === 200) {
                            Swal.fire({
                                title: "Success",
                                icon:"success",
                                text: data.success,
            
                                confirmButtonText: "OK",
                                confirmButtonColor: '#3085d6',
                            })
                            
                        }else if(data.status === 405){
                            Swal.fire({
                                title: "Error",
                                icon:"error",
                                // type: "error",
                                text: data.err,

                                confirmButtonText: "OK",
                                confirmButtonColor: '#d33',

                            });
                        }else if(data.status === 206){
                            Swal.fire({
                                title: "Error",
                                icon:"warning",
                                // type: "error",
                                text: data.warning,

                                confirmButtonText: "OK",
                                confirmButtonColor: '#3085d6',

                            });
                        }
                        
                    }
                });
                
            } else {
                $('#btnCart').html(
                        'THANH TOÁN')
                    .prop('disabled', false);
            }
        })
        
    });
});
$(document).on('submit', '#add_Weapon', function (e) {
    e.preventDefault();
    token();
    let formData = new FormData(jQuery('#add_Weapon')[0]);

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        // dataType: 'json',

        success: function (data) {
            if (data.status === 200) {
                Swal.fire({
                    title: "Success",
                    type: "success",
                    text: data.success,

                    confirmButtonText: "OK"
                });
            } else if (data.status === 400) {
                var errors = data.error;
                $.each(errors, function (field, message) {
                    if (field === 'name') {
                        $("#name-error").text(message);
                        $("#name-error").show();
                    } else if (field === 'files') {
                        $("#files-error").text(message);
                        $("#files-error").show();
                    }
                });
                Swal.fire({
                    title: "Error",
                    type: "error",
                    text: Object.values(errors).join(" & "),

                    confirmButtonText: "OK"
                });
            }
            else {
                Swal.fire({
                    title: "Error",
                    type: "error",
                    text: 'Unknown error, please try again',

                    confirmButtonText: "OK"
                });
            }
        }
    })
})
$(document).on('submit', '#edit_products', function (e) {
    e.preventDefault();
    token();

    var formData = new FormData(jQuery('#edit_products')[0])

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status === 200) {
                Swal.fire({
                    title: "Success",
                    type: "success",
                    text: data.success,

                    confirmButtonText: "OK"
                }).then(function() {
                    
                    location.href = '/admin/list-products';
                });
            } else if (data.status === 400) {
                var errors = data.errors;
                $.each(errors, function (field, message) {
                    if (field === 'name') {
                        $("#name-error").text(message);
                        $("#name-error").show();
                    } else if (field === 'files') {
                        $("#files-error").text(message);
                        $("#files-error").show();
                    }
                });
                Swal.fire({
                    title: "Error",
                    type: "error",
                    text: Object.values(errors).join(" & "),

                    confirmButtonText: "OK"
                });
            }
        }
    })
})
//edit weapons
$(document).on('submit', '#edit_weapons', function (e) {
    e.preventDefault();
    token();

    var formData = new FormData(jQuery('#edit_weapons')[0])

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status === 200) {
                Swal.fire({
                    title: "Success",
                    type: "success",
                    text: data.success,

                    confirmButtonText: "OK"

                }).then((result) => {
                    if (result.value) {
                        window.location = '/admin/list-weapon';
                    }
                });
                // $("#files-error").text(message);

            } else if (data.status === 400) {
                var errors = data.errors;
                $.each(errors, function (field, message) {
                    if (field === 'name') {
                        $("#name-error").text(message);
                        $("#name-error").show();
                    } else if (field === 'files') {
                        $("#files-error").text(message);
                        $("#files-error").show();
                    }
                });
                Swal.fire({
                    title: "Error",
                    type: "error",
                    text: Object.values(errors).join(" & "),

                    confirmButtonText: "OK"
                });
            }
        }
    })
})
$(document).on('submit', '#add_account', function (e) {
    token();
    e.preventDefault();

    var formData = new FormData(jQuery('#add_account')[0]);

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (data) {
            if (data.status === 200) {
                $("#name-error").hide();
                $("#name_account-error").hide();
                $("#pass_account-error").hide();
                $("#price-error").hide();
                $("#files-error").hide();
                Swal.fire({
                    title: "Success",
                    type: "success",
                    text: data.success,

                    confirmButtonText: "OK"

                })
            } else if (data.status === 400) {
                var errors = data.errors;
                $.each(errors, function (field, message) {
                    if (field === 'name') {
                        $("#name-error").text(message);
                        $("#name-error").show();
                    } else if (field === 'account_name') {
                        $("#name_account-error").text(message);
                        $("#name_account-error").show();
                    }
                    else if (field === 'password') {
                        $("#pass_account-error").text(message);
                        $("#pass_account-error").show();

                    } else if (field === 'price') {
                        $("#price-error").text(message);
                        $("#price-error").show();
                    } else if (field === 'files') {
                        $("#files-error").text(message);
                        $("#files-error").show();
                    }
                });
                Swal.fire({
                    title: "Error",
                    type: "error",
                    text: Object.values(errors).join(" & "),

                    confirmButtonText: "OK"
                });
            }
        }


    })
});
$(document).on('submit', '#edit_account', function (e) {
    token();
    e.preventDefault();

    var formData = new FormData(jQuery('#edit_account')[0]);

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (data) {
            if (data.status === 200) {
                $("#name-error").hide();
                $("#name_account-error").hide();
                $("#pass_account-error").hide();
                $("#price-error").hide();
                $("#files-error").hide();
                Swal.fire({
                    title: "Success",
                    type: "success",
                    text: data.success,

                    confirmButtonText: "OK"

                }).then((result) => {
                    if (result.value) {
                        window.location = '/admin/list-account';
                    }
                });

            } else if (data.status === 400) {
                var errors = data.errors;
                $.each(errors, function (field, message) {
                    if (field === 'name') {
                        $("#name-error").text(message);
                        $("#name-error").show();
                    } else if (field === 'account_name') {
                        $("#name_account-error").text(message);
                        $("#name_account-error").show();
                    }
                    else if (field === 'password') {
                        $("#pass_account-error").text(message);
                        $("#pass_account-error").show();

                    } else if (field === 'price') {
                        $("#price-error").text(message);
                        $("#price-error").show();
                    } else if (field === 'files') {
                        $("#files-error").text(message);
                        $("#files-error").show();
                    }
                });
                Swal.fire({
                    title: "Error",
                    type: "error",
                    text: Object.values(errors).join(" & "),

                    confirmButtonText: "OK"
                });
            }
        }


    })
});
// $("#deleteButton").click(function(){
//     var thebuttonclicked =$(this).attr("value");
//sự kiện nhận id trong cart
$(document).on('submit','#buyNow', function(e){
    token();
    e.preventDefault();
    var formData = {
        id: $("#idMoney").val(),
      };
      $.ajax({
        url:$(this).attr('action'),
        type: 'post',
        data:formData,

        success: function(data) {
            if (data.status === 404) {
                Swal.fire({
                    title: "LỖI!",
                    icon:"error",
                    text: data.error,

                    confirmButtonText: "OK",
                    confirmButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        location.href='/login';
                    }
                });
            }else if(data.status === 405){
                Swal.fire({
                    title: "LỖI!",
                    icon:"warning",
                    
                    text: data.error,

                    confirmButtonText: "OK",
                    confirmButtonColor: '#3085d6',
                })
            }else if(data.status === 200){
                Swal.fire({
                    title: "THÀNH CÔNG",
                    icon:"success",
                    // title:'Lỗi',
                    text: data.success,

                    confirmButtonText: "OK",
                    confirmButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        location.href='/';
                    }
                });
            }else if(data.status === 400){
                Swal.fire({
                    title: "LỖI",
                    icon:"error",
                    // title:'Lỗi',
                    text: data.error,

                    confirmButtonText: "OK",
                    confirmButtonColor: '#3085d6',
                })
            }
        }
      })
})

$(document).on('submit','#buyformAddCart', function(e){
    token();
    e.preventDefault();
    var formData = {
        total: $("#buycartId").val(),
      };
      $.ajax({
        url:$(this).attr('action'),
        type: 'post',
        data:formData,

        success: function(data) {
            if (data.status === 404) {
                Swal.fire({
                    title: "LỖI!",
                    icon:"error",
                    text: data.error,

                    confirmButtonText: "OK",
                    confirmButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        location.href='/login';
                    }
                });
            }else if(data.status === 405){
                Swal.fire({
                    title: "LỖI!",
                    icon:"warning",
                    
                    text: data.error,

                    confirmButtonText: "OK",
                    confirmButtonColor: '#3085d6',
                })
            }else if(data.status === 200){
                Swal.fire({
                    title: "THÀNH CÔNG",
                    icon:"success",
                    // title:'Lỗi',
                    text: data.success,

                    confirmButtonText: "OK",
                    confirmButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        location.href='/';
                    }
                });
            }else if(data.status === 400){
                Swal.fire({
                    title: "LỖI",
                    icon:"error",
                    // title:'Lỗi',
                    text: data.error,

                    confirmButtonText: "OK",
                    confirmButtonColor: '#3085d6',
                })
            }
        }
      })
})


$(document).on('submit','#addCard', function (e) {
    token();
    e.preventDefault();

    // let formdata = new FormData(jQuery('#addCard')[0]);
    var formdata = {
        card_network: $("#card_network").val(),
        card_value: $("#card_value").val(),
        card_pin: $("#card_pin").val(),
        card_seri: $("#card_seri").val(),
        
      };
    $.ajax({
        url:$(this).attr('action'),
        type: 'post',
        data: formdata,

        success: function(data){

        }
    })
})
function removeProducts(id) {
    token();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",

        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/remove-product/' + id,
                type: "DELETE",
                success: function (data) {
                    if (data.status === 200) {
                        Swal.fire({
                            title: "Success",
                            type: "success",
                            text: data.success,

                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });

                    }
                }
            });
        }
    });
}
// DELETE WEAPON
function removeWeapon(id) {
    token();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",

        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/remove-weapon/' + id,
                type: "DELETE",
                success: function (data) {
                    if (data.status === 200) {
                        Swal.fire({
                            title: "Success",
                            type: "success",
                            text: data.success,

                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });

                    }
                }
            });
        }
    });
}
function removeAccount(id) {
    token();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",

        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/admin/remove-account/' + id,
                type: "DELETE",
                success: function (data) {
                    if (data.status === 200) {
                        Swal.fire({
                            title: "Success",
                            type: "success",
                            text: data.success,

                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });

                    }
                }
            });
        }
    });
}
function confirmLogout(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Bạn có chắc chắn muốn đăng xuất?',
        icon: 'warning',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy bỏ'
    }).then((result) => {
        if (result.value) {
            document.getElementById('logout-form').submit();
        }
    });
}
// $('#deleteCart').click(function(event) {
//     event.preventDefault();
//     var id =$('#idCart').attr("value");
//   alert(id);
//     $.ajax(this.href, {
//        success: function(data) {
//           $('#main').html($(data).find('#main *'));
//           $('#notification-bar').text('The page has been successfully loaded');
//        },
//        error: function() {
//           $('#notification-bar').text('An error occurred');
//        }
//     });
//  });
function deleteCart(id) {
    // token();
    // console.log(id);
    // var idCart = id;
    Swal.fire({
        title: 'Bạn có muốn xóa tài khoản đã thêm',
        icon: 'info',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        confirmButtonColor: '#3085d6',
        cancelButtonText: 'Hủy bỏ',
        cancelButtonColor: '#d33',

    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/delete-cart/'+id,
                type: "DELETE",
                data : id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
         
                success:function(data) {
                    if (data.status === 200) {
                        location.reload();
                    }
                }
            })
        }
    });
  
    
}