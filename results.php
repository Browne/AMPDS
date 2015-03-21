<!DOCTYPE html>
<html>
<head>
	<title>AMPDS search</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="author" content="Eliot Brown">
	<meta name="description" content="This is designed as an alpha version of a web interface for AMPDS code lookup">
	<meta name="keywords" content="AMPDS, MPDS, APDS,">
	<meta name="og:title" content="AMPDS code search" />
	<meta name="og:description" content="Quickly search the value of AMPDS codes used by some statutory services"/>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/autoJump.js" type="text/javascript"></script>
</head>

<body>
	<?php
				$firstChars = $_GET['firstChars'];
    		$letters = strtoupper($_GET['letters']);
				$final = strtoupper($_GET['final']);
				$code = $firstChars . $letters . $final;
				$sepCode = $firstChars . '-' . $letters . '-' . $final;

				if (($handle = fopen("ampds.csv", "r")) !== FALSE) {
				  $row=0;
				  $csv_row = array();
				  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				    if ($data[0] == $code) {
				      $csv_row = $data;
				    }
				  }

				  fclose($handle);

				}

				else {
					$fail = TRUE;
				}

				switch ($firstChars) {
					case 01:
						$result = "Abdominal Pains/Problems";
						break;
					case 02:
						$result = "Allergies (Reactions)/Envenomations (Stings/Bites)";
						break;
					case 03:
						$result = "Animal Bites/Attacks";
						break;
					case 04:
						$result = "Assualt/Sexual";
						break;
					case 05:
						$result = "Back Pain (Non-Traumatic/Non-Recent)";
						break;
					case 06:
						$result = "Breathing Problems";
					case 07:
						$result = "Burns (Scalds)/Explosions";
						break;
					case 08:
						$result = "Carbon Monoxide/Inhalation/HAZMAT/CBRN";
						break;
					case 09:
						$result = "Cardiac or Respiratory Arrest/Death";
						break;
					case 10:
						$result = "Chest Pain";
						break;
					case 11:
						$result = "Choking";
						break;
					case 12:
						$result = "Convulsions/Seizures";
						break;
					case 13:
						$result = "Diabetic Problems";
						break;
					case 14:
						$result = "Drowning/Diving/SCUBA Accident";
						break;
					case 15:
						$result = "Electrocution/Lightning";
						break;
					case 16:
						$result = "Eye Problems/Injuries";
						break;
					case 17:
						$result = "Falls";
						break;
					case 18:
						$result = "Headache";
						break;
					case 19:
						$result = "Heart Problems/A.I.C.D.";
						break;
					case 20:
						$result = "Heat/Cold Exposure";
						break;
					case 21:
						$result = "Hemorrhage/Lacerations";
						break;
					case 22:
						$result = "Inaccessible Incident/Entrapments";
						break;
					case 23:
						$result = "Overdose/Poisoning (Ingestion)";
						break;
					case 24:
						$result = "Pregnancy/Childbirth/Miscarriage";
						break;
					case 25:
						$result = "Psychiatric/Suicide Attempt";
						break;
					case 26:
						$result = "Sick Person";
						break;
					case 27:
						$result = "Stab/Gunshot/Penetrating Trauma";
						break;
					case 28:
						$result = "Stroke (CVA)/Transient Ischemic Attack (TIA)";
						break;
					case 29:
						$result = "Traffic/Transportation Incidents";
						break;
					case 30:
						$result = "Traumatic Injuries";
						break;
					case 31:
						$result = "Unconscious/Fainting(Near)";
						break;
					case 32:
						$result = "Unknown Problem (Man Down)";
						break;
					case 35:
						$result = "HCP (Health-Care Practitioner) Referral";
						break;

				}
				if (empty($csv_row) == TRUE) {
					$result = "Code not found, please try again";
				}
			?>
	<header class="jumbotron text-center">
		<h1>AMPDS search</h1>
		<div class="container">

			<h2><?php echo $sepCode . ' - ' . $result?></h2>
			<?php if (empty($csv_row) == FALSE) {
				echo "
			<p>" . $csv_row[1] ."</p>
			<p>" . $csv_row[2]  . "</p>";
			}
			?>
		</div>
		<div class="row center-block">
			<form action="results.php" class="form-inline">
				<div class="form-group">
					<label class="sr-only" for="First part of AMPDS code">AMPDS</label>
					<input type="number" name="firstChars" autocomplete="off" min="01" max="35" maxlength="2" class="form-control" placeholder="01" onfocus="this.select(); this.value='';" onblur="this.value=!this.value?'01':this.value;" value="01">
				</div>
				<div class="form-group">
					<label class="sr-only" for="Letter in AMPDS code">AMPDS</label>
					<input type="char" class="form-control" name="letters" autocomplete="off" maxlength="1" onfocus="this.select(); this.value='';" onblur="this.value=!this.value?'a':this.value;" value="a">
				</div>
				<div class="form-group">
					<label class="sr-only" for="Number in AMPDS code">AMPDS</label>
					<input type="text" class="form-control" id="input-small" name="final" autocomplete="off" maxlength="3" onfocus="this.select(); this.value='';" onblur="this.value=!this.value?'01a':this.value;" value="01a">
				</div>
				<button type="submit" class="btn btn-default">Search</button>
			</form>
			<SCRIPT TYPE="text/javascript">
			autojump('firstChars', 'letters', 2);
			autojump('letters', 'final', 1);
			autojump('final', 'send', 3);
			</SCRIPT>

		<p class="lead icons">
			<a href="about.html"><i class="fa fa-info-circle"></i></a>
			<a href="https://github.com/browne/AMPDS"><i class="fa fa-github"></i></a>
		</p>

	</header>


</body>

</html>
