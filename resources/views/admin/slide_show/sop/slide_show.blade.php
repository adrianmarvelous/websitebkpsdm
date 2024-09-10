<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slide Show</title>
</head>
<style>
#slideshow-container {
   width: 100%;
   height: 300px;
   position: relative;
   overflow: hidden;
}
.slide {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   opacity: 0;
   transition: opacity 1s ease-in-out;
}

.slide:first-child {
   opacity: 1;
}
#slideshow-container .slide:nth-child(2) {
   opacity: 1;
   animation: slideshow 5s infinite;
}

#slideshow-container .slide:nth-child(3) {
   opacity: 0;
}

@keyframes slideshow {
   0% { opacity: 0; }
   20% { opacity: 1; }
   80% { opacity: 1; }
   100% { opacity: 0; }
}


</style>
<body>
    <div id="slideshow-container" style="height:1200px">
    @foreach ($sop as $item)
        <div>
            <embed class="slide" src="{{asset('assets/slide_show/sop/'.$item->file)}}#toolbar=0" width="100%" height="100%">
        </div>
    @endforeach
    </div>
<script>
var slideIndex = 0;
var slides = document.getElementsByClassName("slide");

function showSlides() {
   for (var i = 0; i < slides.length; i++) {
      slides[i].style.opacity = 0;
   }
   slideIndex++;
   if (slideIndex > slides.length) {
      slideIndex = 1;
   }
   slides[slideIndex - 1].style.opacity = 1;
   setTimeout(showSlides, 5000); // Change image every 5 seconds
}

showSlides();

</script>
</body>
</html>