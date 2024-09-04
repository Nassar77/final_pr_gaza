<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/doc search.css">
    <link rel="stylesheet" href="style/all.min.css">
    <link rel="stylesheet" href="style/header&footer.css">
    <meta charset="UTF-8">
    <title>search</title>
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

        $err="";
        //الاسم
        $pattern = "/^[a-zA-Z ,.'-]+$/";
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $row ;
            //التاكد من ان حقل الاسم غير فارغ
            if($_POST["name"])
            {
                //للتاكد من ان الاسم لا يحتوى علي ارقام او علامات مميزة
                if (preg_match($pattern, $_POST["name"]))
                {
                    //الحصول علي الاسم من الفورم وتنظيفه من اى زيادات
                    $input_name = test_input($_POST["name"]);
                
                    //استخراج البيانات من قاعدة البيانات 
                    $sql = "SELECT * FROM doctor WHERE name = '".$input_name."' ";
                    $result = $conn->query($sql);
                    //التاكد من ان هناك بيانات باسم هذا الدكتور
                    if ($result->num_rows > 0) 
                    {
                        $row = $result->fetch_assoc();
                        $name = $row["name"];
                        $nation_id= $row["id"];
                        $phone = $row["phone"];
                        $email = $row["email"];
                        $city = $row["residence"];
                        $specialization = $row["specialization"];

                    }else
                    {
                        $err="لا توجد نتائج لهذه البيانات";
                    }
                }
                else
                {
                    $err = "من فضلك ادخل الاسم صحيح و لا يحتوى علي ارقام او علامات مميزة";
                }
            }else
            {
                $err="من فضلك ادخل اسم دكتور";
            }
        $conn->close();
        }
    ?>
    <!--php code-->

    
    <div class="search">
        <div class="contanier">
            <div class="dalil">
            <p>دليل للبحث عن الاطباء </p>
            </div>
            <form action="search.php" method="post">
                <div class="form">
                    <h1>بحث</h1>
                    <input type="search"  name="name"size="30px" placeholder="اسم الدكتور"> 
                    <br>
                    <!--php code-->
                    <div>
                        <center>
                        <?php
                        //لمعرفة هل يوجد اى اخطاء فى الاسم 
                            if($err!="")echo "<span style='color: red;'>$err</span>";
                        ?>
                        </center>
                    </div>
                    <!--php code-->
                    <button>بحث</button>
                   
                </div>
                        <!--البيانات-->
                            <div>
                                    <center>
                                    <?php

                                        if ($_SERVER["REQUEST_METHOD"] == "POST")  
                                        {
                                            echo  $row["name"] ." : الاسم واللقب"."<br>";
                                            echo " رقم التعريف : ". $row["id"]."<br>";
                                            echo $row["phone"].": رقم الهاتف"."<br>";
                                            echo $row["email"].": البريد الالكترون"."<br>";
                                            echo  "التخصص : ".$row["specialization"]."<br>";
                                            echo  "العنوان : ".$row["residence"]."<br>";
                                        }
                                    ?>
                                    </center>
                            </div>
                        <!--البيانات-->
             </div>
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