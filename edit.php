<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style/edit1.css">
    <link rel="stylesheet" href="style/all.min.css">
    <link rel="stylesheet" href="style/header&footer.css">
    <meta charset="UTF-8">
    <title>Editing Form </title>
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
    <!-- start footer -->

    
    <!--php code-->
    <?php
        //صفحة الاتصال بقاعدة البيانات
        require_once "config.php";
        //دلة لتنظيف البيانات
        function test_input ($data)
        {
            $data = trim($data);
            $data = stripslashes ($data); 
            $data = htmlspecialchars ($data);
            return $data;
        }

        $nation_idErr = $emailErr =$phoneErr =$cityErr ="";
        $nation_id = $email = $phone =$city=  "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            // requred nation_id
            if (empty($_POST["nation_id"])) 
            {
                $nation_idErr = "من فضلك تحقق من الرقم القومى";
            } else 
            {
                if (preg_match("/^[0-9]{14}$/", $_POST["nation_id"]))
                {
                    //الحصول علي الرقم القومى من الفورم وتنظيفة من اى زيادات
                    $nation_id = test_input($_POST["nation_id"]);
                }else
                {
                    $nation_idErr = "من فضلك ادخل رقم قومى صحيح مكون من 14 رقم";
                }
            }
            
            if(!empty($_POST["email"]))
            {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    $emailErr = "هذا البريد غير صالح من فضلك ادخل بريد الكترونى صحيح";
                }else
                {
                    $email = test_input($_POST["email"]);
                }
                
            }
            
        
            if(!empty($_POST["phone"]))
            {
                //  التحقق من انا رقم الهاتق يحتوي فقط على ارقام و  مكون من11 رقم 
                if (preg_match("/^[0-9]{11}$/", $_POST["phone"]))
                {
                    //الحصول علي رقم الهاتف من الفورم وتنظيفة من اى زيادات
                    $phone = test_input($_POST["phone"]);
                }
                else
                {
                    $phoneErr = "من فضلك ادخل رقم هاتف صحيح مكون من 11 رقم";
                }
            }


            if(!empty($_POST["city"]))
            {
                $city = test_input($_POST["city"]);
            }
        
            
        $sql="SELECT * FROM doctor WHERE id='". $nation_id ."';";
        $result = $conn->query($sql);

        if (($result->num_rows > 0) )
        {
            if(!$phone=="")
            {
                $sql = "UPDATE doctor SET phone='".$phone."'
                WHERE id='". $nation_id ."';";
                $conn->query($sql) === TRUE;
            }
            if(!$email=="")
            {
                $sql = "UPDATE doctor SET email='". $email ."'
                WHERE id='". $nation_id ."';";
                $conn->query($sql) === TRUE;
            }
            if(!$city=="")
            {
                $sql = "UPDATE doctor SET 
                residence='". $city ."' WHERE id='". $nation_id ."';";
                $conn->query($sql) === TRUE;
            }

        }
        else 
        {
            $res_err= "تاكد من صحة الرقم القومى الخاص بك";
        }
        }
    ?> 
    <!--php code-->


    <div class="edit">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
            <div>
                <h1>تعديل</h1>
                <br> 
                <input type="number" size="30px" name="nation_id" placeholder="الرقم القومي">
                <br>
                <!--php code-->
                <?php  
                    if($nation_idErr=="")
                    {
                        if(!empty( $res_err))
                        {
                            echo "<span style='color: red;'>$res_err</span>";
                        } 
                    }
                    if(isset($nation_idErr))
                    { 
                        echo "<span style='color: red;'> $nation_idErr</span>";
                    }
                ?>
                <!--php code-->
                <br>
                <br>
                <input type="number" size="30px" name="phone" placeholder="رقم الهاتف">
                <br>
                <!--php code-->
                <?php  
                        if(isset($phoneErr))
                        { 
                            echo "<span style='color: red;'> $phoneErr</span>";
                        }
                ?>
                <!--php code-->
                <br>
                <br>
                <br>
                <input type="email" size="30px"name="email" placeholder="البريد الالكتروني">
               
                <br>
                <br>
                
                <br>   
                <input type="text" name="city" placeholder="محل الاقامه">
                <br><br>
                <!--php code-->
                <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST") 
                        {
                            if(empty($phone)&&empty($email)&&empty($city))
                            {
                                echo "<p>من فضلك ادخل القيم الذى تريد تعديلها</p>";
                            }
                        }
                ?>
                <!--php code-->
                <br>
                <br>
                <button type="submit" name="send">تعديل</button>
            </div>
        </form>
    </div>
</div> 
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