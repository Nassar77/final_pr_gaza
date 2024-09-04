<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>section lab</title>
	<link type="image/png" sizes="16*16" rel="icon" href="images/palestine (1).png">
    <!-- templet main css rules -->
    <link rel="stylesheet" href="style/header&footer.css">
    <link rel="stylesheet" href="style/lab.css">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400;500;700&family=Reem+Kufi+Fun:wght@700&display=swap" rel="stylesheet">
    <!-- templet font awesome -->
    <link rel="stylesheet" href="style/all.min.css">
	<link rel="stylesheet" href="style/style">
    <title>غزة</title>
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

			<div class="lab">
				<div class="contanier">
					<p id="par">
						يوفر معمل التحاليل في خدمتكم تحليل وتشخيص العديد من الامراض التشخيص المخبري للحالات الطبيه
						يعتمد المعمل علي فريق متخصص من الخبراء والتقنيين المهرة لضمان الدقة والسرعه في التحاليل
						والتشخيص باستخدام احدث التقنيات الطبية والمعدات المتطورة.يقدم معمل التحاليل نتائج موثوقة ومضمونة
						يقدم المعمل مجموعة واسعة من التحاليل التي تشمل فحص الدم،التحليل البولي،فحص السكر وغيرهاالكثير
						نحن نهتم براحة المرضي ونسعي جاهدين لتوفير تجربة سهلة و مريحة.يتم تنظيم المعمل بشكل مثالي لتوفير الخصوصية
						و الراحة و تقديم الخدمات في اوقات مناسبة
					</p>
					<br><br><br> 
					<form action="المعامل.php " method="post"> 
						<h2>نتائج التحاليل</h2>
						<input type="text" id="nationalid" name="nationalid"required placeholder="الرقم التعريفي ">
						<br>
						<input type="submit" id="searchh" value="بحث">
                        <br>
                        <br>
                        <!--php code-->
						<?php
							//صفحة الاتصال بقاعدة البيانات
							require_once "config.php";

							// POST فحص إذا كانت الطلبات من نوع 
							if ($_SERVER["REQUEST_METHOD"] == "POST") 
							{
								//الحصول علي الرقم التعريفى من الفورم
								$patientID = $_POST['nationalid'];

								if (!empty($patientID)) {
									//التاكد من ان الرقم التعريفي يكون من 3 ارقام
									if (!preg_match("/^[0-9]{3}$/", $patientID)) {
										echo "<span style='color: red;'>يرجى ادخال رقم تعريفي صحيح مكون من 3 ارقام فقط</span>";
									} else 
									{
										if ($patientID >= 201 && $patientID <= 210) 
										{
											//الحصول علي البيانات من قاعدة البيانات
											$sql = "SELECT * FROM laboratory WHERE id = '$patientID'";
											$result = $conn->query($sql);
											//التاكد من ان هناك بيانات لهذا الرقم
											if ($result->num_rows > 0) 
											{
												while ($row = $result->fetch_assoc()) 
												{
													echo "اسم المريض: " . $row["name"]. "<br>";
													echo "نتائج الفحص: ". $row["test"]. "<br>";
													echo "اسم الطبيب: " . $row["doctor"]. "<br>";
													echo "رقم الهاتف : " . $row["phone"]."<br>";
													echo $row["id"]." : "."الرقم التعريفي".  "<br>";
												}
											} 
										} else 
										{
											echo "<span style='color: red;'>رقم الهوية غير صحيح</span>";
										}
									}
								} else {
									echo "<span style='color: red;'>الرجاء إدخال رقم الهوية للبحث</span>";
								}
							}
						?>
						<!--php code-->
					</form>
						
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
