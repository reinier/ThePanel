<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Activation link</h2>
		<div>
			To activate your account, click this link (or copy-paste in browser): {{ URL::to('account/activate', array($hash)) }}
		</div>
	</body>
</html>