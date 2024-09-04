<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>hospital</title>
      <link rel="stylesheet" href="style/pe page.css">
      <link rel="stylesheet" href="style/all.min.css">
      <link rel="stylesheet" href="style/header&footer.css">
      <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
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

        <!--php code-->
        <?php
            // بيانات اتصال قاعدة البيانات
            require_once "config.php";
            
            // دالة لتنظيف البيانات
            function test_input($data) 
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $good="";

            // التحقق من أن الفورم تم إرساله عن طريق الضغط علي احجز الان
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                // الحصل على البيانات المُدخلة من الفورم 
                $name = ($_POST["name"]);
                $phone = ($_POST["phone"]);
                $id = ($_POST["id"]);
                $doctor_name = ($_POST["doctor_name"]);
            
                //  لإدخال البيانات في قاعدة البيانات (الكويري) 
                $sql = "INSERT INTO patient (name, phone, id, doctor) VALUES ('$name', '$phone', '$id', '$doctor_name')";
                
                if (empty($name) || empty($phone) || empty($id) || empty($doctor_name)) {
                } else {
                    // التحقق من صحة البيانات المُدخلة
                    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    } elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
                    } elseif (!preg_match("/^[0-9]{14}$/", $id)) {
                    } elseif (!preg_match("/^[a-zA-Z ]*$/", $doctor_name)) {
                        
                    } else {
            
                        echo "<br>";
                        echo "<br>";
                        if ($conn->query($sql)) {
                            $good="تم الحجز بنجاح";
                            
            
                        } else {
                            echo "Error: " . $conn->error;
                        }
                    }
                
                }
            }
        ?>
        <!--php code-->
        
      <div class="content">
         <div class="container">
            <div class="des">
                <p class="first">نحن هنا من اجلك</p>
                <img src="images/gestures.png" alt="">
            </div>
            <div class="paient-form">
               <form action="paient page.php" method="post">
                  <h1>احجز موعد مع طبيب</h1>
                  <div class="input-box">
                     <input type="text" placeholder="اسمك" name="name" > 
                     <!--php code-->
                     <div>
                        <center>
                           <?php
                            
                                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                                        {
                            
                                    // فحص إذا كانت القيمة فارغة
                                    if (empty($name))
                                    {
                                        echo "<span style='color: red;'>يرجى إدخال الاسم</span>";
                                    } else {
                                        // فحص إذا كانت القيمة تحتوي على أحرف فقط
                                        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                                            echo "<span style='color: red;'>الرجاء إدخال أحرف فقط</span>";
                                        }else
                                        {
                                            //تنظيف الاسم من اى زيادات
                                            $name=test_input($name);
                                        }
                                    }
                                }
                            ?>
                        </center>
                     </div>
                     <!--php code-->
                  </div>
                  <div class="input-box">
                     <input type="tel" placeholder=" رقم التلفون" name="phone" max="11" >
                     <i class='bx bxs-phone'></i>
                     <!--php code-->
                     <div>
                       <center> 
                            <?php
                            
                                    
                                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                                {    
                                    // التحقق مما إذا كان الحقل فارغًا
                                    if (empty($phone)) {
                                        echo "<span style='color: red;'>يرجى إدخال رقم الهاتف </span>";
                                    } else {
                                        // التحقق من صحة الرقم  المُدخل
                                        if (!preg_match("/^[0-9]{11}$/", $phone))  {
                                            echo "<span style='color: red;'> رقم التلفون ايجب أن يتكون من 11 رقم</span>";
                                        }else
                                        {
                                            //تنظيف الرقم
                                            $phone=test_input($phone);
                                        }
                                    }     
                                }                   
                            ?>
                        </center>
                     </div>
                     <!--php code-->
                  </div>
                  <div class="input-box">
                     <input type="text" placeholder="الرقم القومى" name="id" maxlength="14" >
                     <!--php code-->
                     <div>
                        <center> 
                            <?php
                            
                                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                                {
                                // التحقق مما إذا كان الحقل فارغًا
                                if (empty($id)) {
                                    echo "<span style='color: red;'>يرجى إدخال الرقم القومى</span>";
                                } else {
                                    // التحقق من صحة الرقم التعريفي المُدخل
                                    if (!preg_match("/^[0-9]{14}$/", $id)) {
                                        echo "<span style='color: red;'>الرقم التعريفي يجب أن يتكون من 14 رقم</span>";
                                    }else
                                    {
                                        //تنظيف الرقم التعريفى
                                        $id=test_input($id);
                                    }
                                }
                                }
                           ?>
                        </center>
                     </div>
                     <!--php code-->
                  </div>
                  <div class="input-box">
                     <input type="text" placeholder="اسم الدكتور" name="doctor_name" >
                     <!--php code-->
                     <div>
                        <center>  
                            <?php
                            
                                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                                {
                                if (empty($doctor_name)) {
                                    echo "<span style='color: red ;'>يرجى إدخال اسم الدكتور</span>"; 
                                } else {
                                    if (!preg_match("/^[a-zA-Z ]*$/", $doctor_name)) {
                                        echo "<span style='color: red ;'>الرجاء إدخال أحرف ففط</span>";
                                    } else
                                    {
                                        //تنظيف الرقم اسم الدكتور
                                        $doctor_name=test_input($doctor_name);
                                    }
                                }
                                } 
                           ?>
                        </center>
                     </div>
                     <!--php code-->
                  </div>
                  <br><button type="submit" class="button" name="submit"><b>احجز الان</b></button>
                  <!--php code-->
                  <br>
                  <br>
                  <center>
                    <?php
                    
                        if ($_SERVER["REQUEST_METHOD"] == "POST") 
                        {
                            //لو الحجز تم بالفعل يعرف المستخدم
                            if($good!="")
                            {
                                echo "<span style='color: blue ;'>$good </span>";
                            }
                        }    
                    ?>
                  </center> 
                  <!--php code-->
                  
               </form>
            </div>
         </div>
      </div>
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
   </body>
</html>
