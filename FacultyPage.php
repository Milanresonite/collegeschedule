<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty</title>
    <style>
        
        #image{
            text-align: center;
        }
        
        .menu{
            background: aqua;
            height: 50px;
            text-align: center;
        }
        .menu ul li{
            display: inline;
        
            
        }
        .menu a{
            text-decoration: none;
            background: blue;
            font-size: 1.5em;
            color: white;
            margin: 0 55px;;
            padding: 11px;
            display: inline-block;

            
        }
        
        a:hover,a.active{
            text-decoration: none;
            background: black;
            color: white;
            margin: 0 55px;;
            padding: 11px;
            display: inline-block;
            
            
        }
        
        
        
        .output{
            float: right;
            border-collapse: collapse;
            background: pink;
            display: inline-block;
            clear: both;
            position: absolute;
            padding: 3%;
            padding-top: 1%;
            margin: 5%;
            border-radius: 10px;
            
        }
        
        #container{
            float: left;
            background: aqua;
            margin: 5%;
            width: 27%;
            height: auto;
            padding: 5%;
            border: 2px solid red;
            border-radius: 10px;
            font-size: 1.5em;
        }
        #dayid{
            width: 50%;
            font-size: .8em;
            margin-left: 5%;
        }
        #facultyid{
            width: 50%;
            font-size: .6em;
            margin-left: 16%;
        }
        
        #searchbutton{
            padding: 2%;
            font-size: .8em;
            width: 30%;
            display: inline-block;
            position: relative;
            text-align: center;
            margin-left: 20%;
            border-radius: 10px;
            
        }
        #searchbutton:hover{
            background: white;
        }


</style>
    
    
    
</head>

<body>
   
    <div id="image">
    <img src="https://www.gndec.ac.in/sites/default/logo.png" alt="Image Not Available"  >
    </div>  
       
   
   
    <div class="menu">
        <ul>
            <a href="homePage.php"><li>Home</li></a>
            <a href="FacultyPage.php" class="active"><li>Faculty</li></a>
            <a href="roomPage.php"><li>Rooms</li></a>
            <a href="aboutPage.php"><li>About</li></a>
            <a href="helpPage.php"><li>Help</li></a>
        </ul>
    </div>
            
<div id="container">
      <form action="FacultyPage.php" method="post">
         Select Day:
          <select name="day" id="dayid">
           <option value="monday">Monday</option>
           <option value="tuesday">Tuesday</option>
           <option value="wednesday">Wednesday</option>
           <option value="thursday">Thursday</option>
           <option value="friday">Friday</option>
       </select>
       <br><br>
       Faculty: 
       <input list="faculty" name="facultyName" placeholder="Enter Faculty Name" required id="facultyid">
       
       
       <datalist id="faculty">
          
          <?php
           
          $conn = new mysqli('localhost','root','server','college');

            if($conn){
                echo "";
            }
            else{
                die("Connection Failed because ".$conn->connect_error);
            }       
          
         
         $sql = 'select FacultyName from faculty';

        $result = $conn->query($sql);


        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
            $data=$row['name'];
            echo "<option value='$data'>";
            }
            
            }

          
          ?>
         
       </datalist>
       
       
<!--
       <div>
    <script>
        function ShowHideDiv(chktime) {
            var bytime = document.getElementById("bytime");
            bytime.style.display = chktime.checked ? "block" : "none";
        }
   </script>
       
        <input type="checkbox" id="chktime" onclick="ShowHideDiv(this)" />
        By Time
    
    
    
    <div id="bytime" style="display: none">
           Select Time:
          <select name="time">
           <option value="8">8:00 AM</option>
           <option value="9">9:00 AM</option>
           <option value="10">10:00 AM</option>
           <option value="11">11:00 AM</option>
           <option value="12">12:00 PM</option>
           <option value="1">1:00 PM</option>
           <option value="2">2:00 PM</option>
           <option value="3">3:00 PM</option>
           <option value="4">4:00 PM</option>
           <option value="5">5:00 PM</option>
           <option value="6">6:00 PM</option>
       </select>
       </div>
       </div>
       
-->
       
         <br><br><br>
         <input type="submit" value="Search" id="searchbutton">
          
          

       
    </form>
    </div>  
    
    <div class="output">
        
       
        
        

       
       
          
          <?php
          
            
            $day="";
//            $time="";
            $faculty="";
          
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $conn = new mysqli('localhost','root','server','college');

                if($conn){
                    echo "";
                }
                else{
                    die("Connection Failed because ".$conn->connect_error);
                } 
                
                
            if(empty($_POST['day'])){
                $day = "";
            }
            else{
                $day=$_POST['day'];
            }
            if(empty($_POST['facultyName'])){
                $faculty="";
            }
            else{
                $faculty = $_POST['facultyName'];
            }
//            if(empty($_POST['time'])){
//                $time="";
//            }
//            else{
//                $time = $_POST['time'];
//            }
            
              
          
            $sql1 = 'select time,'.$day.' from '.$faculty.'';
              
              $result = $conn->query($sql1);


            $arrtime = array();
       $arrday=array();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                if(strcasecmp($row[$day],'-x-')){
                
              array_push($arrday,$row[$day]);
              array_push($arrtime,$row['time']);
            
  
                    
            }
        
            
            }
            echo " <h3><span style='color:white; font-size:1.2em'>Faculty: </span>$faculty</h3>                    <h3><span style='color:white; font-size:1.2em'>Day:</span> $day</h3>
            
            ";
            echo "<table border='2' style='border-collapse:collapse; font-size:1.1em;'>
       <th>Time</th>
       <th>Schedule</th>";
            
            $rowspanValue=1;
            for($i=0; $i<sizeof($arrday);$i++){
                
                if(($i<sizeof($arrday)-1) && !strcmp($arrday[$i],$arrday[$i+1])){
                    
                    echo "<tr> <td style='padding:3px; text-align:center;'>".$arrtime[$i].":00</td>
                          <td rowspan=2 style='padding:3px; text-align:center;'>".$arrday[$i]."</td>
               
                </tr>";
                    
                    echo "<tr> <td style='padding:3px; text-align:center;'>".$arrtime[$i+1].":00</td>               
                </tr>";
                    $i++;
                
                }
                else{
                    
                    echo "<tr> <td style='padding:3px; text-align:center;'>".$arrtime[$i].":00</td>
                          <td style='padding:3px; text-align:center'>".$arrday[$i]."</td>
               
                </tr>";
                }
                
                
                
                
            }
            
        }

            }
        echo "</table>";
          
          ?>
             
       
   
    </div>
   
</body>
</html>

