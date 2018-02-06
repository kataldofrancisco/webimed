<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
        <title>Clean Slider jQuery Plugin</title>
   	    <meta content="" name="description" />
        <link rel="stylesheet" type="text/css" href="resources/cleanSlider.css" />
        <script type="text/javascript" src="resources/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="resources/jquery.cleanSlider.js"></script>
    </head>
    <body>
        <script>
            $(document).ready(function(){
                var config={};
                config.width =550;  //pixels
                config.height=350;  //pixels 
                config.intervalTime  =5000; //mili-seconds   
                $('.slider').cleanSlider(config);
            })
        </script>
        
          <div class="slider">
              <ul>
                    <li><img src="img/01.jpg" /></li>
                    <li><img src="img/02.jpg" /></li>
                    <li><img src="img/03.jpg" /></li>
                    <li><img src="img/04.jpg" /></li>
                    <li><img src="img/05.jpg" /></li>
                </ul>
            </div>   
        </div>         
    </body>
</html>
