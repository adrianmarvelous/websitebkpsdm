<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <title>SiDAYOH</title>
 <link rel="icon" href="asset/img/logo_pemkot.png" type="image/x-icon"/>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
 <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
 <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
 <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
 <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
 <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
 <link rel="stylesheet" type="text/css" href="assets/css/util.css">
 <link rel="stylesheet" type="text/css" href="assets/css/main.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body>

 <div class="limiter">
  <div class="container-login100" style="background-image: url('assets/images/suroboyo.jpg');">
   <div class="wrap-login100">
    <table border="0" width="110%" style="margin-top: -25px;margin-left: -3px;font-size: 32px;text-shadow: 3px 3px 3px #ababab;">
      <tr>
        <td align="left"><font style="color: white;font-family: Sofia, sans-serif;">SiDAYOH</font></td>
        <td align="right"><img width="110" src="asset/img/logo_pemkot.png"></td>
      </tr>
    </table>
    <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
    <span class="login100-form-logo">
      <img width="130" src="asset/img/logo_BKPSDM.png"></img>
    </span>

    <span class="login100-form-title p-b-34 p-t-27">
        Sistem Informasi 
        <br>
        Daftar Tamu 
        <br>
        Layanan Online Harian
      </span>

    <table  width="100%" style="margin-top: -25px;margin-left: -3px;font-size: 20px;">
      <tr>
        <td align="center"><font style="color: white;font-family: Times New Roman;text-align: center;"><i><u>Rating</u></i></font></td>
      </tr>
    </table>

    <div class="wrap-input100 validate-input" data-validate = "Rating">
      <h4 class="text-center mt-2 mb-4" required>
        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
      </h4>
    </div>

      <!--<div class="wrap-input100 validate-input" data-validate = "Kode Booking">
        <input class="form-control" type="text" name="kode_booking" placeholder="Kode Booking">
      </div>-->

      <div class="wrap-input100 validate-input" data-validate = "">
        <input type="text" name="kode_booking" id="kode_booking" class="form-control" placeholder="Input Kode Booking"/>
      </div>
      <!--<div class="wrap-input100 validate-input" data-validate = "">
        <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
      </div>-->

      <div class="container-login100-form-btn">
        <button class="login100-form-btn" name="Login" type="submit" id="save_review">
         Kirim
       </button>
     </div>
   </div>
 </div>
</div>

<div id="dropDownSelect1"></div>
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<script src="assets/vendor/bootstrap/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/select2/select2.min.js"></script>
<script src="assets/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>

<style>
.progress-label-left
{
  float: left;
  margin-right: 0.5em;
  line-height: 1em;
}
.progress-label-right
{
  float: right;
  margin-left: 0.3em;
  line-height: 1em;
}
.star-light
{
  color:#e9ecef;
}
</style>

<script>

  $(document).ready(function(){

    var rating_data = 0;

    $('#add_review').click(function(){

      $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

      var rating = $(this).data('rating');

      reset_background();

      for(var count = 1; count <= rating; count++)
      {

        $('#submit_star_'+count).addClass('text-warning');

      }

    });

    function reset_background()
    {
      for(var count = 1; count <= 5; count++)
      {

        $('#submit_star_'+count).addClass('star-light');

        $('#submit_star_'+count).removeClass('text-warning');

      }
    }

    $(document).on('mouseleave', '.submit_star', function(){

      reset_background();

      for(var count = 1; count <= rating_data; count++)
      {

        $('#submit_star_'+count).removeClass('star-light');

        $('#submit_star_'+count).addClass('text-warning');
      }

    });

    $(document).on('click', '.submit_star', function(){

      rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){

      var kode_booking = $('#kode_booking').val();

      //var user_review = $('#user_review').val();

      if(kode_booking == '' /*|| user_review == ''*/)
      {
        alert("Please Fill Both Field");
        return false;
      }
      else
      {
        $.ajax({
          url:"submit_rating.php",
          method:"POST",
        data:{rating_data:rating_data, kode_booking:kode_booking, /*user_review:user_review*/},
        success:function(data)
        {
          $('#review_modal').modal('hide');

          load_rating_data();

          alert(data);
        }
      })
      }

    });

    load_rating_data();

    function load_rating_data()
    {
      $.ajax({
        url:"submit_rating.php",
        method:"POST",
        data:{action:'load_data'},
        dataType:"JSON",
        success:function(data)
        {
          $('#average_rating').text(data.average_rating);
          $('#total_review').text(data.total_review);

          var count_star = 0;

          $('.main_star').each(function(){
            count_star++;
            if(Math.ceil(data.average_rating) >= count_star)
            {
              $(this).addClass('text-warning');
              $(this).addClass('star-light');
            }
          });

          $('#total_five_star_review').text(data.five_star_review);

          $('#total_four_star_review').text(data.four_star_review);

          $('#total_three_star_review').text(data.three_star_review);

          $('#total_two_star_review').text(data.two_star_review);

          $('#total_one_star_review').text(data.one_star_review);

          $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

          $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

          $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

          $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

          $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

          if(data.review_data.length > 0)
          {
            var html = '';

            for(var count = 0; count < data.review_data.length; count++)
            {
              html += '<div class="row mb-3">';

              html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].kode_booking.charAt(0)+'</h3></div></div>';

              html += '<div class="col-sm-11">';

              html += '<div class="card">';

              html += '<div class="card-header"><b>'+data.review_data[count].kode_booking+'</b></div>';

              html += '<div class="card-body">';

              for(var star = 1; star <= 5; star++)
              {
                var class_name = '';

                if(data.review_data[count].rating >= star)
                {
                  class_name = 'text-warning';
                }
                else
                {
                  class_name = 'star-light';
                }

                html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
              }

              html += '<br />';

              //html += data.review_data[count].user_review;

              html += '</div>';

              html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

              html += '</div>';

              html += '</div>';

              html += '</div>';
            }

            $('#review_content').html(html);
          }
        }
      })
    }

  });

</script>