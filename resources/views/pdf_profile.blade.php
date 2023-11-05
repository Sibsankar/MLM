<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Associate Joining Form</title>
</head>

<body>
<style>

body { font-family:Arial, Helvetica, sans-serif; width: 2480 px; height: 3508 px; font-size:12px;}

.tableprint {width: 100%;}

.middlediv { margin: auto; width: 60%; }

.selection {background-color: #FFB480;}

.subjects {color: #00034a; font-weight: bold;}

.hidden { display: none;}

table, th, td {
  /*border: 1px solid black;*/
  border-collapse: collapse;
}


@page {
  size: A4;
  margin: 5mm 5mm 5mm 5mm; 
}



@media print 
{
html, body {
    width: 210mm;
    height: 297mm;
  }
  
  .header, .header-space,
.footer, .footer-space {
   height: 80px;
}
.header {
  position: fixed;
  top: 0;
  width: 100%;
}
.footer {
  position: fixed;
  bottom: 0;
}

}

</style>



</head>

<body>


<table width="100%" style="border: 1px solid black; border-collapse: collapse;">
  <tr>
    <td align="center"><img src="https://dvamartnet.com/assets/img/logo/logo.png" height="50px"/></td>
	<td align="center"><h1>DVA MARTNET LIMITED</h1><h3>Gangotri Appt., D-2, Teghoria, Jhowtalla Road, Purbachal, Kolkata - 700 052</h3></td>
  </tr>
  <tr><td colspan="2" align="center" style="background-color: #78E4FF;"><h3>Web: www.dvamartnet.com | E-Mail: dva.kol2001@gmail.com , info@dvamartnet.com | Contact No. (+91) 33 4001 5982</h3></td></tr>
  <tr><td colspan="2" align="center" style="background-color: #0172d0; color:#FFFFFE"><h2>ASSOCIATE JOINING FORM</h2></td></tr>
</table>

<!----------section - Personal details ------------------>	
<h3>Personal Details</h3>
<table width="100%" border="1">  
  <tr>
    <td colspan="2" align="right"><img src="passportphoto.jpg" height="100px"/></td>   
  </tr>
  <tr>
    <td width="30%" class="subjects"><b>Name:</b></td>
    <td>{{$user->details[0]->associate_name}}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Rank:</b></td>
    <td>{{ ($rankData) ? $rankData->rank_name : '' }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Father's / Husband's Name:</b></td>
    <td>{{$user->details[0]->guardians_name}}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Address Line 1:</b></td>
    <td>{{$user->details[0]->address_line1}}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Address Line 2:</b></td>
    <td>{{$user->details[0]->address_line2}}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>City:</b></td>
    <td>{{$getCity->city_name}}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>District:</b></td>
    <td>{{$user->details[0]->district}}</td>   
  </tr>
   <tr>
    <td class="subjects"><b>State:</b></td>
    <td>{{$getState->state_name}}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>PIN Code:</b></td>
    <td>{{$user->details[0]->pin }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Date of Birth:</b></td>
    <td>{{date('d/m/Y', strtotime($user->details[0]->dob))}}</td>   
  </tr>
   <tr>
    <td class="subjects"><b>Gender:</b></td>
    <td>{{$user->details[0]->gender }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Mobile No.:</b></td>
    <td>{{$user->details[0]->phone_no }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Aadhaar No.:</b></td>
    <td>{{$user->details[0]->aadhar_no }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>E-Mail:</b></td>
    <td>{{$user->details[0]->email }}</td>   
  </tr>
</table>  
<!---------------------------------------------------->
<!----------section - Nominee details ------------------>	
<h3>Nominee Details</h3>
<table width="100%" border="1">  
  <tr>
    <td width="30%" class="subjects"><b>Nominee Name:</b></td>
    <td>{{$user->details[0]->nominee_Name }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Relationship with Nominee:</b></td>
    <td>{{$user->details[0]->relation_with_nominee }}</td>   
  </tr>
</table>  
<!---------------------------------------------------->
<!----------section - Sponsor details ------------------>	
<h3>Sponsor Details</h3>
<table width="100%" border="1">  
  <tr>
    <td width="30%" class="subjects"><b>Sponsoring Associate Code:</b></td>
    <td>{{ isset($sponsorDetails[0]->sponsor_code) ? $sponsorDetails[0]->sponsor_code : '' }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Sponsor Rank:</b></td>
    <td>{{ isset($sponsorDetails[0]->rank_name) ? $sponsorDetails[0]->rank_name : '' }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Sponsoring Associate Name:</b></td>
    <td>{{ isset($sponsorDetails[0]->associate_name) ? $sponsorDetails[0]->associate_name : '' }}</td>   
  </tr>
</table>  
<!---------------------------------------------------->
<!----------section - Bank details ------------------>	
<h3>Bank Details</h3>
<table width="100%" border="1">  
  <tr>
    <td width="30%" class="subjects"><b>A/c Holder Name:</b></td>
    <td>{{$user->details[0]->account_holder_name }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Bank Name:</b></td>
    <td>{{$user->details[0]->bank_name }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>Branch Name:</b></td>
    <td>{{$user->details[0]->branch_name }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>A/c No.:</b></td>
    <td>{{$user->details[0]->account_number }}</td>   
  </tr>
  <tr>
    <td class="subjects"><b>IFSC:</b></td>
    <td>{{$user->details[0]->ifc_code }}</td>   
  </tr>
</table>  
<!---------------------------------------------------->

<h3>Date of Joining: {{date('d/m/Y', strtotime($user->details[0]->created_at))}}</h3>

<h3>Documents are required to submit</h3>
<ul>
<li>Photocopy of PAN Card</li>
<li>Photocopy of Address Proof (Aadhaar / Voter ID / Ration Card)</li>
<li>Cancelled Cheque / Photocopy of Bank A/c. Passbook</li>
</ul>

<p align="center" style="background-color: #FFFF00;">This is a computer generated form based on user self submission. Hence does not required any signature.</p>	

</body>
</html>
