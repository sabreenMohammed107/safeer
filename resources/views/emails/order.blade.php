<!DOCTYPE html>
<html>
<head>
	<title>News Letter</title>
	<!--<link type="image/x-icon" rel="icon" href="images/icon.ico">-->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

<style>
body {
    margin: 2em;
    font-family: Arial;
}

.tablerounededCorner {
    border: 1px solid #7a7b7b;
    background-color: #54676529;
    /* border-radius: 1.2em; */
}

.roundedTable {
    border-collapse: collapse;
    /* border-radius: 1.2em; */
    overflow: hidden;
    width: 100%;
    margin: 0;
}

.roundedTable th,
.roundedTable td {
    padding: .6em;
    background: #54676529;
    border-bottom: 1px solid white;
}

.roundedTable th {
    text-align: left;
}
th, td {
  border: 1px solid white;
  padding: 8px;
}


/* .roundedTable tr:last-child td {
    border-bottom: none;
} */
th, td {
  border: 1px solid #ccc;
  padding: 8px;
}


</style>
</head>
<body>
<h3>New Order</h3>
<div class="tablerounededCorner">
    <p class="my-2">Dear Customer,</p>
    <p class="my-2">Thank you for placing your order! It has been received successfully, and we will get in touch with you shortly to complete the process.</p>
    <p class="my-2 ">Order Number: {{$order->id}} – Please keep it for reference.</p>
    <p class="my-2 ">Total Cost: ${{number_format($cost * (1 + (float)$order->tax_percentage/100),2,'.','')}}</p>
    <p class="my-2">If you have any questions, feel free to contact us at Info@Safer.Travel</p>
    <p class="my-2">Best regards,</p>
    <p class="my-2">The Customer Service Team at Safer Travel Company</p>
</div>

</body>
</html>
