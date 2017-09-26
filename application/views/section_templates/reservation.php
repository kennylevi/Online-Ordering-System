<style type="text/css">
     .res-form select.form-control{height: 45px;}
    .res-form select.form-control:focus{box-shadow:none;border-color:transparent;}
    .res-form input, .res-form textarea{
        border-color: rgba(225,225,225,0.83);
        color: #000;
        font-family: georgia, serif;
        box-sizing: border-box;
    }
    .res-form input:focus,.res-form textarea:focus{box-shadow:none;border-color:#ddd;}
    .res-form .reserve{background:#12651e;margin-right:15px;}
    .res-form .btn-default{height:45px;}
    label.error{color:#b91003;}  
     .spin img{height:40px;width:45px;} 
     .spin{display:none;} 
      .alert-danger {
        color: #c9c2c1;
        background-color: #9b0808;
        border-color: #800900;
    }  

    .alert-success {
        color: #e0e4e0;
        background-color: #2f8f07;
        border-color:#2f8f07;
    }
  
    .message{
        margin-top:15px;
    }
</style>
<section id="reservation" class="nav-section">
    <div class="reservation-title">
        <h2>Make A Reservation</h2>
    </div>
    <div class="container">
        <div class="res-form">
            <h5>Place your booking by filling the form below.</h5>
            <form role="form" id="reservationForm">
                <div class="row">
                    <div class="col-sm-5">
                        <p>Select the date for your reservation</p>
                        <div id="datepicker" class="date"></div>
                    </div>
                    <div class="col-sm-7">
                        <p class="res-info">Reservation Information</p>
                           <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <select class="form-control required" name="people" id="people">
                                            <option>People</option>
                                            <?php for ($i=1; $i<=10 ; $i++): ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-8 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <div class="icon-addon addon-lg">
                                            <input type="text" class="form-control required" id="timepicker" name="timepicker" placeholder="Time">
                                            <label for="timepicker" class="fa fa-clock-o"></label>
                                    </div> 
                                    </div>   
                              </div> 
                           </div>
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <div class="icon-addon addon-lg">
                                        <input type="text" name="full_name" class="form-control required" placeholder="Full Name" id="name">
                                        <label for="name" class="fa fa-user"></label>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <div class="icon-addon addon-lg">
                                        <input type="text" name="phone" class="form-control required" placeholder="Phone" id="phone">
                                        <label for="phone" class="fa fa-phone"></label>
                                      </div>
                                  </div>
                              </div>
                          </div>  
                          <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="icon-addon addon-lg">
                                            <input type="text" name="email" class="form-control required email" placeholder="Email" id="email">
                                            <label for="email" class="fa fa-envelope"></label>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea class="form-control required" name="note" id="note" rows="7" placeholder="Notes"></textarea>
                                    </div>
                                </div>
                               <div class="col-xs-7">
                               </div> 
                               <div class="col-xs-5">
                                    <div class="form-group">
                                        <button type="submit" class="w3-round w3-btn pull-right reserve">
                                            Reserve Table 
                                            <span class="spin">
                                                <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>
                                                <span class="sr-only">Loading...</span>
                                            </span>
                                        </button>
                                    </div>
                               </div> 
                                <div class="row">
                                   <div class="col-sm-4 col-md-4"></div>
                                   <div class="col-sm-8 col-md-8">
                                        <div class="message">
                                           
                                        </div>
                                   </div> 
                               </div>
                          </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>
    <script type="text/javascript">
        var siteURL = '<?php echo site_url(); ?>';
        var dateObject = "";
        $(function () {
            $('#people').selectpicker();
            $( "#datepicker" ).datepicker({
                inline:true,
                dateFormat: 'yy-mm-dd',
                onSelect: function() { 
                    dateObject = $(this).datepicker('getDate');
                }
            }); 

            $('#timepicker').timepicki({increase_direction:'up'}); 

            $('#reservationForm').validate({

              submitHandler:function(form){  
               
                    var people = $('#people').val();
                    var time = $('#timepicker').val();
                    var full_name = $('#name').val();
                    var phone = $('#phone').val();
                    var email = $('#email').val();
                    var note = $('#note').val();

                    $('.spin').show();

                    $.ajax({
                        url: siteURL+'Home/post_reservation',
                        type: 'POST',
                        dataType: 'json',
                        data:{
                            // infoValue: true,
                            people: people,
                            timepicker: time,
                            fname: full_name,
                            phone: phone,
                            email: email,
                            note: note,
                            date: dateObject
                        },
                        success:function (data) {
                            $('.spin').fadeOut(2000);
                            $('#reservationForm').trigger('reset');
                            setTimeout(function() {
                                $('.message').html(data.message).delay(10000).fadeOut(500);
                            }, 2000);
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                }    
       
            });

        });
        

    </script>

</section>
<!-- </body>
</html> -->
 