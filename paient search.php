<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>search about paient</title>
    <link rel="stylesheet" href="style/pe search.css ">
    <link rel="stylesheet" href="style/all.min.css">
    <link rel="stylesheet" href="style/header&footer.css">
</head>

<body>
<header>
        <!-- start top bar of page -->
        <div class="top-bar">
            <div class="container">
                <ul>
                    <li> <a href=""><i class="fa-brands fa-youtube" style="color: #747272;"></i></a> </li>
                    <li><a href=""><i class="fa-brands fa-instagram" style="color: #747272;"></i></a></li>
                    <li> <a href=""><i class="fa-brands fa-linkedin" style="color: #747272;"></i></a> </li>
                    <li><a href=""><i class="fa-brands fa-facebook" style="color: #747272;"></i></a> <li>
                    <li><a href="">174454<i class="fa-solid fa-mobile-screen" style="color: #ffffff;"></i></a></li>
                </ul>
                <ul>
                    <li class="icon"><a href="index.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- end top bar of page -->
        <!--start head of page -->
        <div class="head">
            <div class="container">
                <form action="">
                    <input type="submit" value="بحث" id="submit">
                    <input type="text" id="search" name="search" placeholder="ابحث في مستشفي غزة ">
                </form>
                <!-- <div class="logo">
                    <h1>غزه</h1>
                </div> -->
                <div class="logo">
                    <img src="./images/logo gaza1.jfif" alt="error">
                </div>
                
            </div>
        </div>
        <!--end head of page -->
        <!-- start nav of page -->
        <nav >
            <div class="container">
                <ul>
                    <li class="doc"> 
                        <a class="aINdoc" href="">الاطباء</a>
                        <ul class="listINlist"> 
                            <li><a href="ok.php">تسجل دخول</a></li>
                            <li><a href="edit.php">تعديل بيانات</a></li>
                            <li><a href="search.php">بحث</a></li>
                        </ul> 
                    </li>
                    <li class="doc">
                        <a href="#########">خدمات المرضي</a>
                        <ul class="listINlist">
                            <li><a href="paient page.php">حجز</a></li>
                            <li><a href="paient search.php">بحث</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="المعامل.php">المعامل</a>
                    </li>
                    <li><a href="من نحن.php">من نحن</a></li>
                    <li><a href="ask.php">الاساله الشائعه</a></li>
                    <li><a href="#contact">راسلنا</a></li>
                    
                </ul>
            </div>
        </nav>
        <!-- end nav of page -->
    </header>
    <!-- end nav of page -->
    
    <!--php code-->
    <?php
        //صفحة الاتصال بقاعدة البيانات
        require_once "config.php";

        $patientIDerr = "";
        $patientNameerr = $err = "";
        $name = $doctor = $test = $is = "";
        // POST فحص إذا كانت الطلبات من نوع 
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            //الحصول علي الاسم والرقم التعريفي للمريض من الفورم
            $patientID = $_POST['patientID'];
            $patientName = $_POST['name'];

            //التحقق من ان حقل الرقم التعريفي ليس فارغ
            if(empty($patientID))
            {
                $patientIDerr="من فضلك ادخل الرقم القومى";
            }
            //التحقق من ان حقل الاسم ليس فارغ
            if(empty($patientName))
            {
                $patientNameerr="من فضلك ادخل اسم المريض";
            }

            if (!empty($patientID) && !empty($patientName)) 
            {
                //التحقق من ان الاسم يحتوى فقط علي احرف
                if (!preg_match("/^[a-zA-Z ]*$/", $patientName)) 
                {
                    $patientNameerr="برجاء إدخال حروف ومسافات فقط في اسم المريض";
                    if (!preg_match("/^[0-9]{3}$/", $patientID)) 
                    {
                        $patientIDerr="يرجى إدخال رقم تعريفي صحيح";
                    }
                } elseif (!preg_match("/^[0-9]{3}$/", $patientID)) 
                {
                    $patientIDerr="يرجى إدخال رقم تعريفي صحيح";
                } else 
                {
                    if ($patientID >= 101 && $patientID <= 110) 
                    {

                        //الحصول علي البيانات من قاعدة البيانات
                        $sql = "SELECT * FROM patient1 WHERE id = '$patientID' AND name = '$patientName'";   
                        $result = $conn->query($sql);

                         //التاكد من ان هناك بيانات لهذا الرقم
                        if ($result->num_rows > 0) 
                        {
                            if ($row = $result->fetch_assoc()) 
                            {
                                $name=$row["name"];
                                $doctor=$row["doctor"];
                                $test=$row["test"];
                                $id=$row["id"];
                            }
                        } else 
                        {
                            $err="لا توجد نتائج لهذه البيانات";
                        }
                        $conn->close();
                    }else
                    {
                        $patientIDerr="يرجى إدخال رقم تعريفي صحيح";
                    } 
                }
            } 
        }
    ?>
    <!--php code-->
    
    <div class="paient-search">
        <div class="contanier">
            <form action="paient search.php"  method="post">
                <h1>بحث</h1>
                <div class="input-box">
                    <input type="text" placeholder="اسم المريض" name="name" >

                    <!--php code-->
                    <div>
                        <center>
                        <?php
                            if($patientNameerr != "") echo "<span style='color: red;'>$patientNameerr</span>";
                        ?>
                        </center>
                    </div>
                    <!--php code-->

                </div>
                <div class="input-box">
                    <input type="text" placeholder="الرقم التعريفى" name="patientID" maxlength="14" >

                    <!--php code-->
                    <div>
                        <center>
                        <?php
                            if($patientIDerr!= "")echo "<span style='color: red;'>$patientIDerr</span>";
                        ?>
                        </center>
                    </div>
                    <!--php code-->

                </div>
                <button type="submit" class="button">بحث</button>

                <!--php code-->
            <div>
                <center>
                    <?php
                        if($err!="")echo "<span style='color: red;'>$err</span>";
                        else
                        {
                            if($name&&$doctor&&$id&&$test)
                            {
                                echo  $name.":"."اسم المريض" . "<br>";
                                echo  $doctor.":"."اسم الطبيب". "<br>";
                                echo  $test. ":"."نتائج الفحص" ."<br>";
                                echo "الرقم التعريفي:" . $id. "<br>";
                            }
                        }
                    ?>
                </center>
            </div>
    <!--php code-->
            </form>
        </div>
    </div>


</body>
 <!-- start footer -->
 <footer>
        <div class="container">
            <form action="" method="post" id="contact"> 
                <h4>راسلنا</h4>
                <div class="inputs">
                    <div class="mail">
                        <input type="email" name="email" placeholder="البريد الالكتروني" id="mail" method="post">
                        <div class="icon"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></div>
                    </div>
                    <div class="name">
                        <input type="text" name="user-name" placeholder="اسمك" >
                        <div class="icon"><i class="fa-solid fa-user" style="color: #ffffff;" ></i></div>
                    </div>
                </div>
                <textarea name="message" id="message" cols="65" rows="7" placeholder="الرساله"></textarea>
                <input type="submit" value="ارسال" id="submit">
            </form>
            <div class="linkINfooter">
                <h4>الاقسام</h4>
                <div class="partition">
                    <div class="part-one">
                        <ul>
                            <li><a href="#######">وحده الابحتث</a></li>
                            <li><a href="#######">قسم جراحه وزراعه الجهاز الهضمي</a></li>
                            <li><a href="#######">العيادات الخارجيه</a></li>
                            <li><a href="#######">عمليات القلب والصدر</a></li>
                        </ul>
                    </div>
                    <div class="part-two">
                        <ul>
                            <li><a href="#########">اداره المستشفي</a></li>
                            <li><a href="#########">الشهادات والامتيازات</a></li>
                            <li><a href="#########">شركاء النجاح</a></li>
                        </ul>
                    </div>
                </div>
                <div class="iconLink">
                    <div class="phone">
                        <p>174454 <i class="fa-solid fa-mobile-screen" style="color: #ffffff;"></i></p>
                    </div>
                    <div class="icon">
                        <a href=""><i class="fa-brands fa-youtube" style="color: #ffffff;"></i></a>
                        <a href=""><i class="fa-brands fa-instagram" style="color: #ffffff;"></i></a>
                        <a href=""><i class="fa-brands fa-linkedin" style="color: #ffffff;"></i></a>
                        <a href=""><i class="fa-brands fa-facebook" style="color: #ffffff;"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <div class="container">
                <p>تصميم تيم خليها علي الله</p>
                <p>الشروط والأحكام - جميع الحقوق محفوظة © 2023 مستشفى غزة</p>
            </div>
        </div>
    </footer>
    <!-- end footer -->

</html>
