<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>403</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .img-container {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            height: 100vh;
        }

        .img {
            width: 55vw;
            min-width: 50vh;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-user-drag: none;
            user-drag: none;
            -webkit-touch-callout: none;
        }

        *.unselectable {
            -moz-user-select: -moz-none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
</head>

<body ondragstart="return false" ondrop="return false">
    <div class="img-container">
        <img src="{{asset('403.png')}}" class="img unselectable">
    </div>
</body>
<script>
    document.onkeydown = function(e) {
  if(event.keyCode == 123) {
    console.log('You cannot inspect Element');
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
    console.log('You cannot inspect Element');
    return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
    console.log('You cannot inspect Element');
    return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
    console.log('You cannot inspect Element');
    return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
    console.log('You cannot inspect Element');
    return false;
  }
}
// prevents right clicking
document.addEventListener('contextmenu', e => e.preventDefault());
</script>

</html>
