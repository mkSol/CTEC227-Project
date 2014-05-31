<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Generate Data</title>
</head>
<body>
	<?php

	/*

	This script will output a giant list of MySQL queries to fill out the IRS database
	Tables used are: user, equipment, software, userEquip, ticket, ticketComment.

	These tables MUST be empty before importing this data, or the IDs will be misalligned
	due to MySQL auto-increment IDs.
	
	Refreshing the page will yield different randomized results each time,
	Multiple uses of this will not be compatible with eachother.

	By default, this generate 501 users, 350 PCs, 350 laptops, 50 printers, 22 scanners,
	22 fax machines, ~1700 tickets, ticket comments for roughly half of the tickets, and
	reply comments for half of those ticket comments.

	As a note, the password for every user will be unencrypted and set to "password", so
	a MySQL statement must be issued to encrypt passwords to allow logins to work:

	UPDATE user SET passwd = SHA(passwd);

	*/

	function generate_serial() {
		$serial = "";
		for ($i=0; $i < 5; $i++) {
			if ($serial) {
				$serial .= "-"; // Append dash every 5 characters
			}
			for ($x=0; $x < 5; $x++) { 
				if (rand(0,1)) { // Randomly decide letter or number
					$serial .= chr(rand(65,90)); // Append random letter
				} else {
					$serial .= rand(0,9); // Else append a numbe
				}
			}
		}
		return $serial;
	}

	function user_SQL() {
		$helpdeskUsers = [];
		$firstNamesString = "root John Kim Wyoming Dale Phoebe Inga Lydia Tashya Robert Aubrey Bethany Gabriel Wendy Fatima Audrey Wynne Herman Dexter Kennan Cheryl Rae Bree Leila Imani Kevin Ivana Tasha Perry Erich Robert Shanna Ora Blossom Mariko Hollee Cairo Kitra Dennis Olga Hanae Jade Dara Linus Bethany Piper Kibo Illana Kermit Sarah Elaine Lucius Forrest Burton Jamal Abdul Allistair Zelenia Candace Ali Alden Claudia Fallon Ariel Alyssa Garrison Marcia Karyn Yael Nasim Myra Isadora Jada Owen Sybill Wyatt Kay Maxwell Jescie Cedric Amela Chanda Ruth Cynthia Marny Adele Florence Chanda Rama Evelyn Boris Juliet Brian Marny Aladdin Salvador Upton Phoebe Ashely Kaye Audra Bertha Kimberley Mercedes Brent Wynne Isaiah Demetrius Branden Calista Rinah Nola Lance Beverly Lavinia Odysseus Nathan Abel Vernon Jasper Eric Fallon Hillary Berk Zelenia Beatrice Kirsten Ann Micah Claudia Raja Quentin Dean Latifah Hilary Hope Joy Hilel Cassady Briar Cleo Chester Arden Hall Neil Trevor Angelica Raphael Marshall Kim Rajah Henry Willa Ifeoma Elvis Simone Jemima Hedda Kasimir Byron Lara Gareth Jasmine Casey Pascale Abbot Cameron Ocean Harper Plato Beatrice Deirdre Sophia Raphael Vaughan Adria Penelope Debra Nora Brianna Shaine Jolene Debra Leandra Cullen Shay Pascale Gisela Cody Sheila Kevin Piper Dawn Chanda Tyrone Richard Bianca William Kiona Denise Macon Alma Mannix Shannon Madonna Alyssa Jason Yolanda Paula Brynn Miranda Lacota Yoshio Stephanie Francis Kenyon Nissim Jorden Cassady Matthew Dorian Cody Callum Cameron Isadora Yuri Aline Nichole Linda Mercedes Fredericka Brynn Fredericka Giselle Austin Russell Carol Aurelia Bruce Kadeem Ashton Chanda Lucy Rooney Angela Georgia Imani Leo Clio Violet Hanae Herman Curran Christen Andrew Quail Amir Lewis Yael Yoko Ralph Melissa Simon Olympia Ella Harding Elvis Bevis Salvador Zachary Neville Zahir Gannon Ocean Jamalia Melissa Elijah Russell Dolan Signe Noelle Adam Hamilton Yolanda Barrett Isadora Trevor Miranda Daryl Cole Daphne Boris Xandra Lana Isabelle Lana Guy Stephen August Germaine Jorden Medge Isabella Bruno Jerry Dacey Yvette Jenette Yeo Elizabeth Herrod Vielka Lee Barrett Vivien Seth Hakeem Garth Galena Tanek Yuri Kiona Phelan Maisie Andrew Flavia Miriam Darryl Wilma Ryan Anastasia Amethyst Hadassah Nash Autumn Macon Chanda Nissim Aretha Xavier Zenaida Shelby Reagan Hamish Jade Quentin Evangeline Aurora Paki Jonah Nathaniel Flavia Honorato Igor Demetrius Cally Signe Bertha Kai Elton Alexis Cassidy Britanney Kylie Fletcher Sigourney Yolanda Fatima Jescie Olivia Fletcher Connor Melanie Tatum James Yoshio Hayfa Conan Daniel Kitra Zephr Shelby Jael Shad Dustin Frances Dora Zelda Holmes Evan Ivana Cedric Calista Hall Stuart Reed Jocelyn MacKensie Taylor Simon Taylor Aiko Rhoda Alice Emi Brianna Yolanda Ivy Tatyana Rhea Charde Henry Alana Naida Dane Roanna Rafael Elijah Nichole Mechelle Raya Darrel Nola Keely Inez Jillian Nomlanga Abra Rana Seth Dane Zoe Alfreda Gillian Joy Abel Thor David Nicole Amber Hop Gillian Keane Griffith Eagan Hermione Noah Madison Raya Nissim Tanisha Maxwell Idona William Bruno Ian August Margaret Olivia Zachary Elton Yvonne Nigel Cameran Cynthia Rylee Upton Jana Robin Grace Hiroko Noelani Russell Josephine Mikayla Nell Hadley Ingrid Violet Herrod Stewart Faith Nathan Sloane Penelope Carol Caesar Zahir Wade Hamilton Shellie Dora Leo Kai Eve Vincent Aiko Quintessa Ursula Chase Angelica";
		$firstNames = explode(" ", $firstNamesString);

		$lastNamesString = "oot Doe Duran Salinas Bullock Drake Hunter Soto Finch White Knowles Burke Henry Justice Chandler Sandoval Stuart Frederick Gordon Humphrey Mcintyre Hammond Foley Ayala Hampton Rush Burton Brock Guthrie Shepard Giles Underwood Mendoza Griffith Turner Wilkins Hood Eaton Battle Whitley Robles Kinney Leonard Jackson Parks Bullock Cunningham Schultz Sloan Reyes Mathis Manning Scott Williamson Estes Dillard Maynard Horn Austin Fisher Vazquez Cooke Whitfield Sherman Blair Nicholson Stokes Davidson Wiggins Bruce Welch House Buckner Mckenzie Richard Gallagher Long Ayers Horn Barry Guzman Browning Salas Bullock Moreno Fry Webster Adkins Mcmahon George Dawson Jordan Carey Snyder Ferguson Pearson West Ramos Gordon Green Bailey Page Pacheco Burris Guzman Espinoza Burnett Lawrence Petersen Cross Henderson Padilla Chambers Huber Hawkins Leon Fleming Gonzales Mullen Barlow Obrien Maynard Mayo May Weber Osborn Blevins Powell Duran Ewing Atkinson Espinoza Shaw Guerra Brady Randolph Bowers Sloan Grimes Harmon Landry Barnes Drake Fuller Medina Williamson Carney Lopez Schroeder Steele Blair Mccullough Ayala Buchanan Duran Winters Santiago Estrada Richmond Wong Owen Nielsen Woodward Clements Banks Farmer Nunez Golden Carter Small Jennings Cervantes Simpson Wynn Santos Romero Carey Guzman Snyder Wallace Brennan Moore Bird Lester Richardson Black Compton Marshall Cummings Guthrie Mason Shelton Howe Gilliam Young Mcneil Gay Hopkins Dunn Keith Baker Sweet Hancock Chapman Odonnell Wise Walters Herrera Myers Lawrence Pruitt Bond Suarez Kramer Hester Osborn Duncan Patrick Vinson Berry Lane Blackburn Mcleod Adkins Sweeney Hoffman Powell Stanley Bray Whitaker Perry Ochoa Crane Sexton Brennan Farley Leon Daniels Frazier Bailey Wilkins William Johnston Hancock Golden Huffman Travis Mcneil Vega Simon Macdonald Horne Reilly Landry Roberson Huff Lee Kidd Nunez Carver Guthrie Leon Velez Bowman Wolf Vance Kennedy Conway Sanford Fields Lindsay Williams Walsh Harper Hunter Ray Blackwell Richmond Velez Dillon Schwartz Guerra Nguyen Bauer Donovan West Pearson Ferrell Patrick Carrillo Bishop Hayden Turner Solis Crawford Landry Mcdonald Weeks Pace Diaz Carter Contreras Trevino Owens Clarke Hill Benson Munoz Jensen Pitts Dorsey Norton Morales Cunningham Adkins Morris Winters Barker Saunders Frost Hurley Henderson Carpenter Acosta Hurley Carey Harrison Browning Mcgee Tate Stokes Fleming Rodriguez Valenzuela Alvarez Lindsay Bell Foley Miller Koch Sparks Greene Rivas Bolton Benjamin Bentley Workman Church Eaton Dyer Oconnor Jennings Sargent Leon Hendrix Chang Juarez Ashley Marquez Whitaker Page Burns Holloway Saunders Chambers Ruiz Willis Barlow Berry Kline Sykes Gregory Townsend Fuller Ochoa Clemons Mack Mueller Gordon Cobb Wooten Reynolds Fletcher Gates Byrd Mayer Trevino Bates Lucas Mcgowan Henderson Austin Kirk Palmer Martinez Newton Webb Cooke Mclean Best Walker Fisher Douglas Fitzpatrick Simmons Sampson Conrad Rivas Walls Blair Craig Durham Carrillo Austin Fitzpatrick Hatfield Day Walters Washington Ryan Gonzalez Hammond Sears Waller Santos Warren Hines Hess Cooper Levy Gonzalez Gonzales Gibson Workman Cherry Case Merritt Schwartz Simpson Buck Maldonado Nunez Bryant Velez Tate Prince Olsen Pittman Cooley Mcmahon Branch Riddle Walsh Frank Alvarez Holden Herrera Sellers Wise Rowland Gomez Cooley Torres Norris Dyer Dunn Ware Britt Walker Bowen Tate Marquez Caldwell Horn Rosa Lott King Terry Bradley Hughes Pugh Hurst Gross Powers Pace Steele Warren Riddle Everett Colon Morris Mays Bruce Stephenson English Aguirre Guthrie Casey Coffey Mckinney Kim Russo";
		$lastNames = explode(" ", $lastNamesString);
		for ($n=0; $n < 500; $n++) { 
			$username = strtolower(substr($firstNames[$n], 0, 1)) . strtolower($lastNames[$n]);
			$email = $username . "@greenwellbank.com";
			$privRand = rand(1,9);
			switch ($privRand) { // privLevel 1-5 = User, 6-7 = helpdesk, 8 = manager, 9 = admin
				case ($privRand < 6):
					$privLevel = "1";
					break;
				case ($privRand < 8):
					$privLevel = "2";
					array_push($helpdeskUsers, $n + 1);
					break;
				case '8':
					$privLevel = "3";
					break;
				case '9':
					$privLevel = "4";
					break;
			}
			if ($privLevel == "3") {
				$department = "1";	
			} else {
				$department = rand(2,11);
			}
			$dateRegistered = rand(2002,2014) . "-" . rand(1,12) . "-" . rand(1,28);
			$datePasswd = "2014-" . rand(3,4) . "-" . rand(1,28);
			echo '<pre>' . 'INSERT INTO user (username,passwd,dateRegistered,datePassword,firstName,lastName,email, department,privilege) VALUES ("' . $username . '","password","' . $dateRegistered . '","' . $datePasswd . '","' . $firstNames[$n] . '","' . $lastNames[$n] . '","' . $email . '","' . $department . '","' . $privLevel . '");' . '</pre>' . "\n";
		}
		return $helpdeskUsers;
	}

	function equip_SQL() {
		// Need: equipType, equipSerial, EquipDesc
		$desktopModels = ["Dell Inspiron 1764","Dell Inspiron E1405","Dell Inspiron 1525","Lenovo C460","Lenovo C560","Acer Aspire TC Series","Acer Aspire U Series","Asus Essentio A10 Series","Asus Essentia M51AD","Asus i5 ET2321","Samsung ATIC A6 Series"];
		$laptopModels = ["Lenovo X1 Carbon","Lenovo X240","Lenovo X140e","Lenovo X131e","Dell Latitude E6430","Dell Latitude E6530","Dell Latitude E6440","Toshiba Satellite C55","Asus X200MA","Toshiba Satellite P55T","Toshiba Satellite E45T"];
		$printerModels = ["HP Officejet Pro 8600","HP Lasterjet Pro 200","Epson 700 Ink Jet Printer","Epson WorkForce Pro 4010","Epson Workforce Pro 4533"];
		$scannerModels = ["Cannon CanoScan LiDE 110 Scanner","Fujitsu ScanSnap iX500 Scanner","Epson Perfection V500 Scanner"];
		$faxModels = ["Ricoh 1190 Fax","Ricoh 3320I Fax","Toshiba DP190f FAX","Panasonic UF-4500 Fax"];
		for ($desktops=0; $desktops < 350; $desktops++) { 
			$desktopModel = $desktopModels[rand(0,10)];
			$desktopWords = explode(" ", $desktopModel);
			$equipSerial = strtoupper(substr($desktopWords[0], 0, 3)) . "-" . strtoupper(substr($desktopWords[1], 0, 2)) . "-" . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
			echo '<pre>' . 'INSERT INTO equipment (equipType,equipSerial,equipDesc) VALUES ("' . "1" . '","' . $equipSerial . '","' . $desktopModel . '");' . '</pre>';
		}
		for ($laptops=0; $laptops < 350; $laptops++) { 
			$laptopModel = $laptopModels[rand(0,10)];
			$laptopWords = explode(" ", $laptopModel);
			$equipSerial = strtoupper(substr($laptopWords[0], 0, 3)) . "-" . strtoupper(substr($laptopWords[1], 0, 2)) . "-" . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
			echo '<pre>' . 'INSERT INTO equipment (equipType,equipSerial,equipDesc) VALUES ("' . "2" . '","' . $equipSerial . '","' . $laptopModel . '");' . '</pre>';
		}
		for ($depts=0; $depts < 11; $depts++) { 
			for ($i=0; $i < 2; $i++) { // Populate printers
				$printerModel = $printerModels[rand(0,4)];
				$printerWords = explode(" ", $printerModel);
				$equipSerial = strtoupper(substr($printerWords[0], 0, 3)) . "-" . strtoupper(substr($printerWords[1], 0, 2)) . "-" . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
				echo '<pre>' . 'INSERT INTO equipment (equipType,equipSerial,equipDesc) VALUES ("' . "3" . '","' . $equipSerial . '","' . $printerModel . '");' . '</pre>';
			}
			for ($i=0; $i < 2; $i++) { // Populate scanners
				$scannerModel = $scannerModels[rand(0,2)];
				$scannerWords = explode(" ", $scannerModel);
				$equipSerial = strtoupper(substr($scannerWords[0], 0, 3)) . "-" . strtoupper(substr($scannerWords[1], 0, 2)) . "-" . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
				echo '<pre>' . 'INSERT INTO equipment (equipType,equipSerial,equipDesc) VALUES ("' . "3" . '","' . $equipSerial . '","' . $scannerModel . '");' . '</pre>';
			}
			for ($i=0; $i < 2; $i++) { // Populate fax machines
				$faxModel = $faxModels[rand(0,3)];
				$faxWords = explode(" ", $faxModel);
				$equipSerial = strtoupper(substr($faxWords[0], 0, 3)) . "-" . strtoupper(substr($faxWords[1], 0, 2)) . "-" . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
				echo '<pre>' . 'INSERT INTO equipment (equipType,equipSerial,equipDesc) VALUES ("' . "3" . '","' . $equipSerial . '","' . $faxModel . '");' . '</pre>';
			}
		}
	}

	function user_equip_SQL() {
		// Need: equipID, userID, deptID
		// 501 users, 350 desktops, 350 laptops
		// 11 departments. 50 printers, 22 scanners, 22 fax machines
		// equipID 0-349 Desktop, 350-699 Laptop, 700-749 Printer, 750-771 Scanner, 772-793 Fax
		// Departments 12: HR, IT, Management, Marketing, Customer Service, Operations, Financial, Services, Quality Assurance, Sales, Purchasing, Research & Development

		// --- Users
		$deskCount = "1";
		$lapCount = "351";
		$printerCount = "700";
		$scannerCount = "750";
		$faxCount = "772";
		for ($user=0; $user < 501; $user++) { 
			$bothChance = rand(0,3);
			if ($bothChance == "1") {
				echo '<pre>' . 'INSERT INTO userEquip (equipID,userID) VALUES ("' . $deskCount . '","' . $user . '");' . '</pre>';
				echo '<pre>' . 'INSERT INTO userEquip (equipID,userID) VALUES ("' . $lapCount . '","' . $user . '");' . '</pre>';
				$deskCount++;
				$lapCount++;
			} else {
				$desktopChance = rand(0,1);
				if ($desktopChance) {
				echo '<pre>' . 'INSERT INTO userEquip (equipID,userID) VALUES ("' . $deskCount . '","' . $user . '");' . '</pre>';
				$deskCount++;
				} else {
					echo '<p>' . 'INSERT INTO userEquip (equipID,userID) VALUES ("' . $lapCount . '","' . $user . '");' . '</pre>';
					$lapCount++;
				}
			}
		}
		// --- Departments
		for ($dept=0; $dept < 11; $dept++) { 
			for ($i=0; $i < rand(3,4); $i++) { 
				echo '<pre>' . 'INSERT INTO userEquip (equipID,deptID) VALUES ("' . $printerCount . '","' . $dept . '");' . '</pre>';
				$printerCount++;
				//echo "PRINTER!";
			}
			for ($i=0; $i < rand(1,2); $i++) { 
				echo '<pre>' . 'INSERT INTO userEquip (equipID,deptID) VALUES ("' . $scannerCount . '","' . $dept . '");' . '</pre>';
				$scannerCount++;
				//echo "SCANNER!";
			}
			for ($i=0; $i < 2; $i++) { 
				echo '<pre>' . 'INSERT INTO userEquip (equipID,deptID) VALUES ("' . $faxCount . '","' . $dept . '");' . '</pre>';
				$faxCount++;
				//echo "FAX!";
			}
		}
	}

	function software_SQL() {
		$windows = ["Microsoft Windows XP Professional","Microsoft Windows 7","Microsoft Windows 8"];
		$office = ["Microsoft Office 2007 Professional","Microsoft Office 2012 Professional","Microsoft Office 2013 Professional","Libre Office","Open Office"];
		$adobe = "Adobe Acrobat XI PRO";
		$emailclient = ["Mozilla Thunderbird","Microsoft Outlook 2013"];
		$ide = ["Visual Studio 2012","Eclipse","Sublime Text 2"];
		$browser = ["Mozilla Firefox","Google Chrome","Internet Explorer"];
		for ($equipID=0; $equipID < 699; $equipID++) { 
			$ideChance = rand(0,1);
			if ($ideChance) {
				echo '<pre>' . 'INSERT INTO software (softwareName,softwareSerial,equipID) VALUES ("' . $ide[rand(0,2)] . '","' . generate_serial() . '","' . $equipID . '");' . '</pre>';
			}
			echo '<pre>' . 'INSERT INTO software (softwareName,softwareSerial,equipID) VALUES ("' . $office[rand(0,3)] . '","' . generate_serial() . '","' . $equipID . '");' . '</pre>';
			echo '<pre>' . 'INSERT INTO software (softwareName,softwareSerial,equipID) VALUES ("' . $adobe . '","' . generate_serial() . '","' . $equipID . '");' . '</pre>';
			echo '<pre>' . 'INSERT INTO software (softwareName,softwareSerial,equipID) VALUES ("' . $emailclient[rand(0,1)] . '","' . generate_serial() . '","' . $equipID . '");' . '</pre>';
			echo '<pre>' . 'INSERT INTO software (softwareName,softwareSerial,equipID) VALUES ("' . $windows[rand(0,2)] . '","' . generate_serial() . '","' . $equipID . '");' . '</pre>';
			echo '<pre>' . 'INSERT INTO software (softwareName,softwareSerial,equipID) VALUES ("' . $browser[rand(0,2)] . '","' . "" . '","' . $equipID . '");' . '</pre>';
		}

	}

	function ticket_SQL($helpdeskUsers) {
		// Ticket Needs: userID, statusID, categoryID, priorityID, assignedTo, timestamp, issueDesc
		$softwareIssue = [
			"My word processor doesn't start up?",
			"My word processor freezes randomly",
			"Email client closes by itself every ten minutes or so!",
			"Acrobat won't run until it gets updates.",
			"Is there any way to get a newer version of spreadsheet software?",
			"Word sometimes locks up without notice",
			"Excel takes too long to start up. It's been getting worse and worse over time.",
			"MS Access isn't able to connect to the database!",
			"ACCESS ODBC connection is gone.",
			"I can't find My Documents!",
			"Cannot save files in Word",
			"Cannot open files in any office program!",
			"My files keep disappearing!",
			"Cannot connect to database?",
			"Cannot access network resources at all.",
			"Office is missing from my computer.",
			"Web pages freeze the computer",
			"Why won't this page load in the browser?",
			"Unable to access Greenwell resources online!",
			"I can't log into the computer!!"
		];
		$softwareComment = [
			//"My word processor doesn't start up?",
			"Did you open it up from the start menu?",
			//"My word processor freezes randomly",
			"How long does it usually take to freeze?",
			//"Email client closes by itself every ten minutes or so!",
			"You didn't close it yourself?",
			//"Acrobat won't run until it gets updates.",
			"It shouldn't require updates to run.",
			//"Is there any way to get a newer version of spreadsheet software?",
			"Nope.",
			//"Word sometimes locks up without notice",
			"",
			//"Excel takes too long to start up. It's been getting worse and worse over time.",
			"",
			//"MS Access isn't able to connect to the database!",
			"",
			//"ACCESS ODBC connection is gone.",
			"We're working on the issue. The database server is on the fritz.",
			//"I can't find My Documents!",
			"",
			//"Cannot save files in Word",
			"Is your hard drive full?",
			//"Cannot open files in any office program!",
			"",
			//"My files keep disappearing!",
			"Did you save them?",
			//"Cannot connect to database?",
			"We're working on the issue. The database server is on the fritz.",
			//"Cannot access network resources at all.",
			"We're working on the issue. The database server is on the fritz.",
			//"Office is missing from my computer.",
			"Look for Libre Office. It's the same thing.",
			//"Web pages freeze the computer",
			"",
			//"Why won't this page load in the browser?",
			"",
			//"Unable to access Greenwell resources online!",
			"",
			//"I can't log into the computer!!"
			""
		];
		$hardwareIssue = [
			"My computer doesn't turn on anymore. Power button seems to do nothing. Is my computer dead?",
			"Black screen on start up? All I can hear is a hum, but nothing else.",
			"Computer seems like it's dead and doesn't turn on.",
			"Cannot get into Windows.",
			"I have a crack in my screen.",
			"A key fell out of my keyboard omg!",
			"The keyboard doesn't do anything anymore.",
			"Keyboard is acting weird. Hitting one key types out the wrong letter!",
			"The mouse stops working once in a while",
			"The light under the mouse flickers...",
			"My computer's mouse stopped responding entirely.",
			"Keyboard and mouse stopped responding.",
			"Broken wire on the mouse?"
		];
		$hardwareComment = [
			//"My computer doesn't turn on anymore. Power button seems to do nothing. Is my computer dead?",
			"Did you try plugging it in?",
			//"Black screen on start up? All I can hear is a hum, but nothing else.",
			"Did you try plugging it in?",
			//"Computer seems like it's dead and doesn't turn on.",
			"Did you try plugging it in?",
			//"Cannot get into Windows.",
			"What appears on the screen?",
			//"I have a crack in my screen.",
			"It should be harmless. Nothing can be done till new computers are rolled out in your department.",
			//"A key fell out of my keyboard omg!",
			"We'll get you a new keyboard.",
			//"The keyboard doesn't do anything anymore.",
			"",
			//"Keyboard is acting weird. Hitting one key types out the wrong letter!",
			"Is it still set to QWERTY format?",
			//"The mouse stops working once in a while",
			"",
			//"The light under the mouse flickers...",
			"Is the mouse plugged in fully into the USB socket?",
			//"My computer's mouse stopped responding entirely.",
			"",
			//"Keyboard and mouse stopped responding.",
			"",
			//"Broken wire on the mouse?"
			"We'll get you a new mouse.",
		];
		$emailIssue = [
			"Any emails I send don't go through.",
			"Emails don't send!",
			"What was my email address?",
			"Why did my email change?",
			"Unable to log into my email.",
			"Email not set up right. Something about SMTP?",
			"Email not working, it complains about POP?",
			"POP and SMTP settings seem to be broken after the latest update.",
			"How can I find my email?",
			"I typed up an email and it disappeared. What do?!",
			"I have TOO MUCH SPAM! HELP!!",
			"There are far too many emails in my inbox."
		];
		$emailComment = [
			//"Any emails I send don't go through.",
			"Are you connected to the internet first?",
			//"Emails don't send!",
			"Is your PC connected to the network?",
			//"What was my email address?",
			"",
			//"Why did my email change?",
			"New company policy.",
			//"Unable to log into my email.",
			"",
			//"Email not set up right. Something about SMTP?",
			"",
			//"Email not working, it complains about POP?",
			"The company email server is down for maintainence.",
			//"POP and SMTP settings seem to be broken after the latest update.",
			"",
			//"How can I find my email?",
			"Open up your email client.",
			//"I typed up an email and it disappeared. What do?!",
			"Deal with it.",
			//"I have TOO MUCH SPAM! HELP!!",
			"Deal with it.",
			//"There are far too many emails in my inbox."
			"Deal with it.",
		];
		$periphIssue = [
			"I can't print anymore.",
			"Paper jam preventing me from getting this document done.",
			"Our department printer has a paper jam.",
			"No more paper in the printer",
			"The low toner light went on and now print outs are super faded!",
			"How do I connect to the printer?",
			"My computer has no printer drivers.",
			"No drivers? Word doesn't let me print.",
			"Scanner doesn't respond.",
			"How does a fax machine work? I tried kicking it, but nothing happened!",
			"Scanner resolution is far too low. How can it be fixed?",
			"Scanner doesn't work on my PC because of something about DRIVERS",
			"Fax Machine does not get past dial tone.",
		];
		$periphComment = [
			//"I can't print anymore.",
			"Is the printer on?",
			//"Paper jam preventing me from getting this document done.",
			"We're working on this issue.",
			//"Our department printer has a paper jam.",
			"",
			//"No more paper in the printer",
			"Your department tech should have access to more paper.",
			//"The low toner light went on and now print outs are super faded!",
			"",
			//"How do I connect to the printer?",
			"",
			//"My computer has no printer drivers.",
			"They should come pre-installed. Check your driver listing?",
			//"No drivers? Word doesn't let me print.",
			"",
			//"Scanner doesn't respond.",
			"Is it plugged in?",
			//"How does a fax machine work? I tried kicking it, but nothing happened!",
			"",
			//"Scanner resolution is far too low. How can it be fixed?",
			"Unfortunately, we're limited to the current equipment we have on hand and the resolution can't be raised.",
			//"Scanner doesn't work on my PC because of something about DRIVERS",
			"",
			//"Fax Machine does not get past dial tone.",
			"Try dialing the fax number.",
		];
		$generalIssue = [
			"My chair is too tall!",
			"How I mine for fish?",
			"Cubicle wall fell down.",
			"Why are the computers no longer stocked with OSX?",
			"Why can't I connect to the wireless with my iphone?",
			"My personal laptop doesn't connect to the network",
			"Please help me set up my new computer.",
			"Change details of my user account?",
			"I forgot my login password!",
			"Lost password. What can I do?",
			"Brand new computer. How do I install the company software on it?",
			"My computer is on fire!",
			"The gremlins inside the screen are telling me to burn things!",
		];
		$generalComment = [
			//"My chair is too tall!",
			"",
			//"How I mine for fish?",
			"",
			//"Cubicle wall fell down.",
			"We can't do anything about this.",
			//"Why are the computers no longer stocked with OSX?",
			"Proprietary software used by Greenwell Bank requires Windows to operate.",
			//"Why can't I connect to the wireless with my iphone?",
			"Greenwell Bank doesn't support personal devices on the wireless network.",
			//"My personal laptop doesn't connect to the network",
			"",
			//"Please help me set up my new computer.",
			"",
			//"Change details of my user account?",
			"",
			//"I forgot my login password!",
			"We'll reset your password.",
			//"Lost password. What can I do?",
			"We'll reset your password.",
			//"Brand new computer. How do I install the company software on it?",
			"",
			//"My computer is on fire!",
			"Try gasoline?",
			//"The gremlins inside the screen are telling me to burn things!",
			"Have you tried bargaining with them?",
		];
		$response = ["I tried, but it doesn't work!","Okay, I'll try that.","That doesn't work either."];
		$ticketID = "1";
		for ($userID=0; $userID < 501; $userID++) { 
			// Open tickets
			for ($open=0; $open < rand(0,2); $open++) { 
				$randCategory = rand(1,5);
				$date = rand(2013,2014) . "-" . rand(1,12) . "-" . rand(1,28);
				switch ($randCategory) {
					case '1':
						$issueDesc = $hardwareIssue[rand(0,count($hardwareIssue) - 1)];
						break;
					case '2':
						$issueDesc = $softwareIssue[rand(0,count($softwareIssue) - 1)];
						break;
					case '3':
						$issueDesc = $emailIssue[rand(0,count($emailIssue) - 1)];
						break;
					case '4':
						$issueDesc = $periphIssue[rand(0,count($periphIssue) - 1)];
						break;
					case '5':
						$issueDesc = $generalIssue[rand(0,count($generalIssue) - 1)];
						break;
				}
				echo '<pre>' . 'INSERT INTO ticket (userID,statusID,categoryID,priorityID,assignedTo,timestamp,issueDesc) VALUES ("' . $userID . '","' . "1" . '","' . $randCategory . '","' . rand(1,3) . '","' . "" . '","' . $date . '","' . $issueDesc . '");' . '</pre>';
				//echo "<p>$ticketID</p>";
				$ticketID++;
			}
			// Assigned Tickets
			for ($open=0; $open < rand(0,2); $open++) { 
				$randCategory = rand(1,5);
				$date = rand(2013,2014) . "-" . rand(1,12) . "-" . rand(1,28);
				$assignedTo = $helpdeskUsers[rand(0,count($helpdeskUsers) - 1)];
				switch ($randCategory) {
					case '1':
						$rand = rand(0,count($hardwareIssue) - 1);
						$issueDesc = $hardwareIssue[$rand];
						$comment = $hardwareComment[$rand];
						break;
					case '2':
						$rand = rand(0,count($softwareIssue) - 1);
						$issueDesc = $softwareIssue[$rand];
						$comment = $softwareComment[$rand];
						break;
					case '3':
						$rand = rand(0,count($emailIssue) - 1);
						$issueDesc = $emailIssue[$rand];
						$comment = $emailComment[$rand];
						break;
					case '4':
						$rand = rand(0,count($periphIssue) - 1);
						$issueDesc = $periphIssue[$rand];
						$comment = $periphComment[$rand];
						break;
					case '5':
						$rand = rand(0,count($generalIssue) - 1);
						$issueDesc = $generalIssue[$rand];
						$comment = $generalComment[$rand];
						break;
				}
				echo '<pre>' . 'INSERT INTO ticket (userID,statusID,categoryID,priorityID,assignedTo,timestamp,issueDesc) VALUES ("' . $userID . '","' . "2" . '","' . $randCategory . '","' . rand(1,3) . '","' . $assignedTo . '","' . $date . '","' . $issueDesc . '");' . '</pre>';
				if (rand(0,1)) { // chance for ticket to have a helpdesk comment
					if ($comment) { // if there's a comment available for this ticket issue...
						echo '<pre>' . 'INSERT INTO ticketComment (ticketID,userID,comment,timestamp) VALUES ("' . $ticketID . '","' . $assignedTo . '","' . $comment . '","' . $date . '");' . '</pre>';
						if (rand(0,1)) { // chance for a reply comment from user
							echo '<pre>' . 'INSERT INTO ticketComment (ticketID,userID,comment,timestamp) VALUES ("' . $ticketID . '","' . $userID . '","' . $response[rand(0,2)] . '","' . $date . '");' . '</pre>';
						}
					}
				}
				//echo "<p>$ticketID</p>";
				$ticketID++;
			}
			// Closed (Fixed)
			for ($open=0; $open < rand(0,2); $open++) { 
				$randCategory = rand(1,5);
				$date = rand(2013,2014) . "-" . rand(1,12) . "-" . rand(1,28);
				$assignedTo = $helpdeskUsers[rand(0,count($helpdeskUsers) - 1)];
				switch ($randCategory) {
					case '1':
						$rand = rand(0,count($hardwareIssue) - 1);
						$issueDesc = $hardwareIssue[$rand];
						$comment = $hardwareComment[$rand];
						break;
					case '2':
						$rand = rand(0,count($softwareIssue) - 1);
						$issueDesc = $softwareIssue[$rand];
						$comment = $softwareComment[$rand];
						break;
					case '3':
						$rand = rand(0,count($emailIssue) - 1);
						$issueDesc = $emailIssue[$rand];
						$comment = $emailComment[$rand];
						break;
					case '4':
						$rand = rand(0,count($periphIssue) - 1);
						$issueDesc = $periphIssue[$rand];
						$comment = $periphComment[$rand];
						break;
					case '5':
						$rand = rand(0,count($generalIssue) - 1);
						$issueDesc = $generalIssue[$rand];
						$comment = $generalComment[$rand];
						break;
				}
				echo '<pre>' . 'INSERT INTO ticket (userID,statusID,categoryID,priorityID,assignedTo,timestamp,issueDesc) VALUES ("' . $userID . '","' . "3" . '","' . $randCategory . '","' . rand(1,3) . '","' . $assignedTo . '","' . $date . '","' . $issueDesc . '");' . '</pre>';
				if (rand(0,1)) { // chance for ticket to have a helpdesk comment
					if ($comment) { // if there's a comment available for this ticket issue...
						echo '<pre>' . 'INSERT INTO ticketComment (ticketID,userID,comment,timestamp) VALUES ("' . $ticketID . '","' . $assignedTo . '","' . $comment . '","' . $date . '");' . '</pre>';
						if (rand(0,1)) { // chance for a reply comment from user
							echo '<pre>' . 'INSERT INTO ticketComment (ticketID,userID,comment,timestamp) VALUES ("' . $ticketID . '","' . $userID . '","' . $response[rand(0,2)] . '","' . $date . '");' . '</pre>';
						}
					}
				}
				//echo "<p>$ticketID</p>";
				$ticketID++;
			}
			// Closed (WillNotFix)
			for ($open=0; $open < rand(0,2); $open++) { 
				$randCategory = rand(1,5);
				$date = rand(2013,2014) . "-" . rand(1,12) . "-" . rand(1,28);
				$assignedTo = $helpdeskUsers[rand(0,count($helpdeskUsers) - 1)];
				switch ($randCategory) {
					case '1':
						$rand = rand(0,count($hardwareIssue) - 1);
						$issueDesc = $hardwareIssue[$rand];
						$comment = $hardwareComment[$rand];
						break;
					case '2':
						$rand = rand(0,count($softwareIssue) - 1);
						$issueDesc = $softwareIssue[$rand];
						$comment = $softwareComment[$rand];
						break;
					case '3':
						$rand = rand(0,count($emailIssue) - 1);
						$issueDesc = $emailIssue[$rand];
						$comment = $emailComment[$rand];
						break;
					case '4':
						$rand = rand(0,count($periphIssue) - 1);
						$issueDesc = $periphIssue[$rand];
						$comment = $periphComment[$rand];
						break;
					case '5':
						$rand = rand(0,count($generalIssue) - 1);
						$issueDesc = $generalIssue[$rand];
						$comment = $generalComment[$rand];
						break;
				}
				echo '<pre>' . 'INSERT INTO ticket (userID,statusID,categoryID,priorityID,assignedTo,timestamp,issueDesc) VALUES ("' . $userID . '","' . "4" . '","' . $randCategory . '","' . rand(1,3) . '","' . $assignedTo . '","' . $date . '","' . $issueDesc . '");' . '</pre>';
				if (rand(0,1)) { // chance for ticket to have a helpdesk comment
					if ($comment) { // if there's a comment available for this ticket issue...
						echo '<pre>' . 'INSERT INTO ticketComment (ticketID,userID,comment,timestamp) VALUES ("' . $ticketID . '","' . $assignedTo . '","' . $comment . '","' . $date . '");' . '</pre>';
						if (rand(0,1)) { // chance for a reply comment from user
							echo '<pre>' . 'INSERT INTO ticketComment (ticketID,userID,comment,timestamp) VALUES ("' . $ticketID . '","' . $userID . '","' . $response[rand(0,2)] . '","' . $date . '");' . '</pre>';
						}
					}
				}
				//echo "<p>$ticketID</p>";
				$ticketID++;
			}
		}
	}

	// ------------------------------------ Mainline Logic : Where The Magic Happens ------------------------------------

	// Statement to use correct DB
	echo "<pre>USE irs;</pre>";
	// Print out all users and store helpdesk userIDs in a varaible
	$helpdesk = user_SQL();
	// Print out all equipment
	equip_SQL();
	// Print out equipment assignment to users
	user_equip_SQL();
	// Print out software assignment to equipment
	software_SQL();
	// Print out tickets and ticket comments, passing in list of helpdesk userIDs for ticket assignment
	ticket_SQL($helpdesk);

	?>
</body>
</html>