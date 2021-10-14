<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.pack.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="popup center">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <div class="title">
            Success!
        </div>
        <div class="description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias nihil provident
            voluptatem nulla placeat.
        </div>
        <div class="dismiss-btn">
            <button id="dismiss-popup-btn">
                Dismiss
            </button>
        </div>
    </div>
    <div class="center">
        <button id="open-popup-btn">
            Open Popup
        </button>
    </div>
    <script>
        document.getElementById("open-popup-btn").addEventListener("click", function() {
            document.getElementsByClassName("popup")[0].classList.add("active");
        });

        document.getElementById("dismiss-popup-btn").addEventListener("click", function() {
            document.getElementsByClassName("popup")[0].classList.remove("active");
        });
    </script>
</body>

</html>