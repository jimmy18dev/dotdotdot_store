<?php
require_once'config/autoload.php';
//include'sdk/facebook-sdk/autoload.php';
//include'facebook.php';
$current_page = "customer";

if(isset($_GET['id'])){
	$bank->GetBank(array('bank_id' => $_GET['id']));
}
?>

<!DOCTYPE html>
<html lang="th" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">	

<?php
//include'favicon.php';
?>

<title>Bank</title>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>

<!-- JS Lib -->
<script type="text/javascript" src="js/lib/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/service/bank.service.js"></script>

</head>

<body>
<?php include'header.php';?>
<div class="container">
	<div class="topic">
		<div class="topic-caption">Bank</div>
	</div>

	<div class="content">
		<div class="bank-form">
			<div class="form-items">
				<div class="caption">ธนาคาร</div>
				<div class="input">
					<select id="code">
						<option value="BBL" <?php echo ($bank->code=="BBL"?'selected':'');?>>ธนาคารกรุงเทพ</option>
						<option value="BAY" <?php echo ($bank->code=="BAY"?'selected':'');?>>ธนาคารกรุงศรีอยุธยา</option>
						<option value="KBANK" <?php echo ($bank->code=="KBANK"?'selected':'');?>>ธนาคารกสิกรไทย</option>
						<option value="KTB" <?php echo ($bank->code=="KTB"?'selected':'');?>>ธนาคารกรุงไทย</option>
						<option value="SCB" <?php echo ($bank->code=="SCB"?'selected':'');?>>ธนาคารไทยพาณิชย์</option>
						<option value="TMB" <?php echo ($bank->code=="TMB"?'selected':'');?>>ธนาคารทหารไทย</option>
						<option value="GSB" <?php echo ($bank->code=="GSB"?'selected':'');?>>ธนาคารออมสิน</option>
					</select>
				</div>
			</div>
			<div class="form-items">
				<div class="caption">สาขา</div>
				<div class="input">
					<input type="text" id="branch" value="<?php echo $bank->account_branch;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">ชื่อบัญชี</div>
				<div class="input">
					<input type="text" id="name" value="<?php echo $bank->account_name;?>">
				</div>
			</div>
			<div class="form-items">
				<div class="caption">เลขบัญชี</div>
				<div class="input">
					<input type="text" id="number" value="<?php echo $bank->account_number;?>">
				</div>
			</div>

			<input type="text" id="bank_id" value="<?php echo $bank->id;?>">
			<div class="form-submit">
				<button onclick="javascript:CreateBank();">SAVE</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>