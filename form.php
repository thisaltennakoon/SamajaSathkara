<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF49;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a048;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f1;
  padding: 20px;
}
</style>
</head>
<body>

<h3>Contact Form</h3>

<div class="container">
  <form action="hello.php" method="post" />

    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Kumar">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Sangakkara">

    <label for="email">Email Address</label>
    <input type="text" id="email" name="email" placeholder="computer@gmail.com">

    <label for="pnumber">Phone Number</label>
    <input type="text" id="pnumber" name="pnumber" placeholder="0717303215">

    <label for="message">Message</label>
    <input type="text" id="message" name="message" placeholder="Enter Your Message">

    </select>

    
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
