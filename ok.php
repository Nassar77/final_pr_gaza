<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="style/sign.css">
    <link rel="stylesheet" href="style/all.min.css">
    <link rel="stylesheet" href="style/header&footer.css">
    <meta charset="UTF-8">
    <title>Hospital Website</title>
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

        //صفحة الاتصال بقاعدة البيانات
        require_once "config.php";

        //لتنظيف البيانات
        function test_input ($data)
        {
            $data = trim($data);//remvo whitespace 
            $data = stripslashes ($data);// 
            $data = htmlspecialchars ($data);//converts spciel characters into html entites
            return $data;
        }

        //الاسم
        $pattern = "/^[a-zA-Z ,.'-]+$/";
        //العنوان
        $pattern2 = "/^[a-zA-Z 1-9  ,.'-]+$/";
        //رقم الهاتف
        $pattern3 = "/^[0-9]{11}$/";
        //الرقم القومى
        $pattern4 = "/^[0-9]{14}$/";

        $name = $id = $phone = $email = $addr = $good = $DR = "";
        $name_err = $id_err = $phone_err = $email_err = $addr_err =$DR_err = "";

        // POST فحص إذا كانت الطلبات من نوع 
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // التحقق من ان حقل الاسم ليس فارغ
            if(empty($_POST["name"])) 
            {
                $name_err = "من فضلك تحقق من الاسم او اللقب";
            } else 
            {
                // (,.-)التحقق من ان الاسم يحتوي فقط على أحرف و العلامات 
                if (preg_match($pattern, $_POST["name"]))
                {
                    //الحصول علي الاسم من الفورم وتنظيفه من اى زيادات
                    $name = test_input($_POST["name"]);
                }else
                {
                    $name_err = "من فضلك ادخل الاسم صحيح و لا يحتوى علي ارقام او علامات مميزة";
                }
            }

            // التحقق من ان حقل الرقم القومى ليس فارغ
            if(empty($_POST["id"])) 
            {
                $id_err = "من فضلك تحقق من الرقم القومى";
            } else 
            {
                //  التحقق من ان الرقم القومى يحتوي فقط على ارقام و  مكون من14 رقم 
                if (preg_match($pattern4, $_POST["id"]))
                {
                    //الحصول علي الرقم القومى من الفورم وتنظيفة من اى زيادات
                    $id = test_input($_POST["id"]);
                }else
                {
                    $id_err = "من فضلك ادخل رقم قومى صحيح مكون من 14 رقم";
                }
            }
            
            
            // التحقق من ان حقل رقم الهاتف ليس فارغ
            if(empty($_POST["phone"])) 
            {
                $phone_err = "من فضلك تحقق من رقم الهاتف";
            } else 
            {
                //  التحقق من ان رقم الهاتق يحتوي فقط على ارقام و  مكون من11 رقم 
                if (preg_match($pattern3, $_POST["phone"]))
                {
                    //الحصول علي رقم الهاتف من الفورم وتنظيفة من اى زيادات
                    $phone = test_input($_POST["phone"]);
                }
                else
                {
                    $phone_err = "من فضلك ادخل رقم هاتف صحيح مكون من 11 رقم";
                }
            }

            // التحقق من ان حقل البريد الالكترونى ليس فارغ
            if(empty($_POST["email"])) 
            {
                $email_err = "من فضلك تحقق من البريد الالكترونى";
            } else 
            {
                if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
                {
                    //الحصول علي البريد الالكترونى من الفورم وتنظيفة من اى زيادات
                    $email = test_input($_POST["email"]);
                }else
                {
                    $email_err = "هذا البريد غير صالح من فضلك ادخل بريد الكترونى صحيح";
                }
                
            }


            // التحقق من ان حقل العنوان ليس فارغ
            if(empty($_POST["addr"])) 
            {
                $addr_err = "من فضلك تحقق من العنوان";
            } else 
            {

             //لان الحقل فى الفورم من النوع
            /* if (preg_match($pattern, $_POST["addr"]))
                {
                    $addr = $_POST["addr"];
                }else
                {
                    $addr_err = "من فضلك ادخل عنوان صحيح";
                }*/


                //الحصول علي العنوان من الفورم وتنظيفة من اى زيادات
                $addr = test_input($_POST["addr"]);
            }

            // التحقق من ان حقل التخصص ليس فارغ
            if(empty($_POST["DR"])) 
            {
                $DR_err = "من فضلك تحقق من تخصصك";
            } else 
            {
                //الحصول علي التخصص من الفورم وتنظيفة من اى زيادات
                $DR = test_input(($_POST["DR"]));
            }
            
            
            //if(empty($name_err)&&empty($id_err)&&empty($phone_err)&&empty($email_err)&&empty($addr_err)&&empty($DR_err))
            //if(isset($name_err)||isset($id_err)||isset($phone_err)||isset($email_err)||isset($addr_err)||isset($DR_err))
            if(($name_err)==""&&$id_err==""&&$phone_err==""&&$email_err==""&&$addr_err==""&&$DR_err=="")
            {
                //لادخال البيانات فى قاعدة البيانات باستخدمة sql
                $sql="INSERT INTO doctor (name, id,residence,phone,email,specialization)
                VALUES('". $name ."', '". $id ."', '". $addr ."', '" .$phone ."' , '". $email ."' ,'". $DR ."')";
    
                if ($conn->query($sql) === TRUE)
                {
                    $good="تم التسجيل بنجاح";
                } 
            }
        }
    ?>
    <!--php code-->

    <div class="log-in">
        <form method="post">
            <div class="form">
                <h1>تسجيل</h1>
                <br>
                <input type="text" name="name" size="30px" placeholder="الاسم">
                <br>
                <br>

                <!--php code-->
                <div>
                    <center>
                    <?php
                       //لمعرفة هل يوجد اى اخطاء فى الاسم 
                        if(isset($name_err))echo "<span style='color: red;'>$name_err</span>";
                    ?>
                    </center>
                </div>
                <!--php code-->

                <br>
                <input type="number" name="id" size="30px" placeholder="الرقم القومي">
                <br>
                <br>

                 <!--php code-->
                 <div>
                    <center>
                    <?php
                         //لمعرفة هل يوجد اى اخطاء فى الرقم القومى 
                        if(isset($id_err))echo "<span style='color: red;'>$id_err</span>";
                    ?>
                    </center>
                </div>
                <!--php code-->

                <br>
                <input type="number" name="phone" size="30px" placeholder="رقم الهاتف">
                <br>
                <br>

                 <!--php code-->
                 <div>
                    <center>
                    <?php
                        //لمعرفة هل يوجد اى اخطاء فى رقم الهاتف 
                        if(isset($phone_err))echo "<span style='color: red;'>$phone_err</span>";
                    ?>
                    </center>
                </div>
                <!--php code-->
               
                <br>
                <input type="email" name="email" size="30px" placeholder="البريد الالكتروني">
                <br>
                <br>
                
                <!--php code-->
                <div>
                    <center>
                    <?php
                         //لمعرفة هل يوجد اى اخطاء فى البريد الالكترونى 
                        if(isset($email_err))echo "<span style='color: red;'>$email_err</span>";
                    ?>
                    </center>
                </div>
                <!--php code-->
                
                <br>   
                <input type="text" name="addr" placeholder="العنوان">
                <br>
                <br>

                <!--php code-->
                <div>
                    <center>
                    <?php
                    //لمعرفة هل يوجد اى اخطاء فى العنوان 
                        if(isset($addr_err))echo "<span style='color: red;'>$addr_err</span>";
                    ?>
                    </center>
                </div>
                <!--php code-->
            
                <br>
                <input type="text" name="DR" placeholder="التخصص">
                <br>
                <br>

                <!--php code-->
                <div>
                    <center>
                    <?php
                        //لمعرفة هل يوجد اى اخطاء فى التخصص 
                        if(isset($DR_err))echo "<span style='color: red;'>$DR_err</span>";
                    ?>
                    </center>
                </div>
                <!--php code-->

                <br>
                <button type="submit">تسجيل</button>
            </div>
            <br>

            <!--php code-->
            <div>
                <center>
                    <?php
                        //لو الحجز تم بالفعل بعرف المستخدم
                        if($good!="")
                        {
                            echo "<span style='color: green ;'>$good </span>";
                        }
                    ?>
                </center> 
            </div>
           <!--php code-->

        </form>
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

