<?php
    $conn = new mysqli("localhost", "root", "", "testtask");

    if($conn->connect_error)
    {
        die("Ошибка: " . $conn->connect_error);
    }
    $id = 0;
    $Lastname = "";
    $Firstname = "";
    $Middlename = "";
    $SeriyaNomerPasport = "";
    $ContactInformation = "";
    $Adres = "";
    $Otdel = "";
    $Doljnost = "";
    $SalaryAmount = "";
    $DateEmployment = "";
    $update = false;

    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        $update = true;
        $sql = "SELECT id, Lastname, Firstname, Middlename, SeriyaNomerPasport, ContactInformation, Adres, idOtdela, idDoljnosti, SalaryAmount, DateEmployment, Dismissed FROM sotrudniki where id = ". $id;
        $record = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($record);
        $Lastname = $row['Lastname'];
        $Firstname = $row['Firstname'];
        $Middlename = $row['Middlename'];
        $SeriyaNomerPasport = $row['SeriyaNomerPasport'];
        $ContactInformation = $row['ContactInformation'];
        $Adres = $row['Adres'];
        $Otdel = $row['idOtdela'];
        $Doljnost = $row['idDoljnosti'];
        $SalaryAmount = $row['SalaryAmount'];
    }
    if(isset($_GET['dismiss']))
    {
        $id = $_GET['dismiss'];
        $sqlDismiss = "update sotrudniki set Dismissed = 1 where id = $id";
        mysqli_query($conn, $sqlDismiss);
        header('location: index.php');
    }
    if(isset($_POST['add']))
    {
        $Lastname = $_POST['TbFamiliya'];
        $Firstname = $_POST['TbImya'];
        $Middlename = $_POST['TbOtchestvo'];
        $SeriyaNomerPasport = $_POST['TbPasport'];
        $ContactInformation = $_POST['TbTelephone'];
        $Adres = $_POST['TbAdres'];
        $Otdel = $_POST['CbAddOtdel'];
        $Doljnost = $_POST['CbAddDlojnost'];
        $SalaryAmount = $_POST['TbSalaryAmount'];
        $sqlInsert = "insert into sotrudniki (Lastname, Firstname, Middlename,SeriyaNomerPasport, ContactInformation, Adres, idOtdela, idDoljnosti,SalaryAmount, DateEmployment, Dismissed)
        VALUES('$Lastname', '$Firstname', '$Middlename', '$SeriyaNomerPasport', '$ContactInformation', '$Adres', '$Otdel', '$Doljnost', '$SalaryAmount', CURDATE(), 0)";
        mysqli_query($conn, $sqlInsert);
        header('location: index.php');
    }
    if(isset($_POST['save']))
    {
        $id = $_POST['id'];
        $Lastname = $_POST['TbFamiliya'];
        $Firstname = $_POST['TbImya'];
        $Middlename = $_POST['TbOtchestvo'];
        $SeriyaNomerPasport = $_POST['TbPasport'];
        $ContactInformation = $_POST['TbTelephone'];
        $Adres = $_POST['TbAdres'];
        $Otdel = $_POST['CbAddOtdel'];
        $Doljnost = $_POST['CbAddDlojnost'];
        $SalaryAmount = $_POST['TbSalaryAmount'];
        $sqlUpdate = "update sotrudniki set Lastname = '$Lastname', Firstname = '$Firstname', Middlename = '$Middlename', SeriyaNomerPasport = '$SeriyaNomerPasport', ContactInformation = '$ContactInformation', Adres = '$Adres', idOtdela = '$Otdel', idDoljnosti = '$Doljnost', SalaryAmount = '$SalaryAmount' where id = $id";
        mysqli_query($conn, $sqlUpdate);
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Учет сотрудников</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Учет сотрудников</h1>
    </header>
    <main>
        <?php
            $OtdelFilter = isset($_GET['CbOtdel']) ? $_GET['CbOtdel'] : '';
            $DoljnostFilter = isset($_GET['CbDlojnost']) ? $_GET['CbDlojnost'] : '';
            $Poisk = isset($_GET['TbPoisk']) ? $_GET['TbPoisk'] : '';
            $sql = "SELECT sotrudniki.id, Lastname, Firstname, Middlename, SeriyaNomerPasport, ContactInformation, Adres, otdel.Name as OtdelName, doljnost.Name as DoljnostName, SalaryAmount, DateEmployment, CASE when Dismissed=0 THEN 'Не уволен' when Dismissed=1 THEN 'Уволен' END as Dismissed FROM sotrudniki join otdel on sotrudniki.idOtdela = otdel.id JOIN doljnost on sotrudniki.idDoljnosti = doljnost.id where 1=1;";
            if($OtdelFilter)
            {
                $sql .= " and idOtdela = ". $OtdelFilter;
            }
            if($DoljnostFilter)
            {
                $sql .= " and idDoljnosti = ". $DoljnostFilter;
            }
            if($Poisk)
            {
                $sql .= " and Lastname like '%". $Poisk ."%' or Firstname like '%". $Poisk ."%' or Middlename like '%". $Poisk ."%'";
            }
            if($result = $conn -> query($sql))
            {
                $rowsCount = $result -> num_rows;
                echo "<table><tr><th>Код</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Серия/Номер паспорт</th><th>Контактная информация</th><th>Адрес проживания</th><th>Отдел</th><th>Должность</th><th>Размер зарплаты</th><th>Дата принятия на работу</th><th>Статус</th><th>Действия</th></tr>";
                foreach($result as $row)
                {
                    echo "<tr>";
                        echo "<th>".$row["id"]."</th>";
                        echo "<td>".$row["Lastname"]."</td>";
                        echo "<td>".$row["Firstname"]."</td>";
                        echo "<td>".$row["Middlename"]."</td>";
                        echo "<td>".$row["SeriyaNomerPasport"]."</td>";
                        echo "<td>".$row["ContactInformation"]."</td>";
                        echo "<td>".$row["Adres"]."</td>";
                        echo "<td>".$row["OtdelName"]."</td>";
                        echo "<td>".$row["DoljnostName"]."</td>";
                        echo "<td>".$row["SalaryAmount"]."</td>";
                        echo "<td>".$row["DateEmployment"]."</td>";
                        echo "<td>".$row["Dismissed"]."</td>";
                        if($row["Dismissed"] == "Уволен")
                            echo "<td><a>Изменить</a><br><a>Уволить</a></td>";
                        else
                            echo "<td><a href='index.php?edit=".$row['id']."'>Изменить</a><br><a href = 'index.php?dismiss=".$row['id']."'>Уволить</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                $result ->free();
            }
            else
                echo "Ошибка: ". $conn->error;
        ?>
        <div class = "BlockFilter">
            <form method="GET" action="">
                <b>Фильтрация</b><br>
                <p>Отдел:
                    <select name = "CbOtdel">
                        <?php
                            $sql = "select id, Name from otdel";
                            if($result = $conn ->query($sql))
                            {
                                $rowsCount = $result -> num_rows;
                                echo "<option disabled selected>Выберите Отдел</option>";
                                foreach($result as $row)
                                {
                                    echo "<option value=".$row["id"].">".$row["Name"]."</option>";
                                }
                                $result ->free();
                            }
                            else
                                echo "Ошибка: ". $conn->error;
                        ?>
                    </select>
                </p>
                <p>Должность:
                    <select name="CbDlojnost">
                        <?php
                            $sql = "select id, Name from doljnost";
                            if($result = $conn ->query($sql))
                            {
                                $rowsCount = $result -> num_rows;
                                echo "<option disabled selected>Выберите должность</option>";
                                foreach($result as $row)
                                {
                                    echo "<option value=".$row["id"].">".$row["Name"]."</option>";
                                }
                                $result ->free();
                            }
                            else
                                echo "Ошибка: ". $conn->error;
                        ?>
                    </select>
                </p>
                <p><b>Поиск </b><input type="text" name = "TbPoisk"></p>
                
                <button type = "submit">ТЫК!!!</button>
            </form>
        </div>
        <div class = "BlockAddEdit">
            <h2><?php echo $update ? 'Изменить запись' : 'Добавить запись'; ?></h2>
            <Form method = "POST">
                <input type="hidden" name = "id" value = "<?php echo $id; ?>">
                <p>Фамилия: <input type="text" name = "TbFamiliya" value = "<?php echo $Lastname; ?>"></p>
                <p>Имя: <input type="text" name = "TbImya" value = "<?php echo $Firstname; ?>"></p>
                <p>Отчество: <input type="text" name = "TbOtchestvo" value = "<?php echo $Middlename; ?>"></p>
                <p>Серия/номер паспорт: <input type="text" name = "TbPasport" pattern = "\d{4} \d{6}" placeholder="0000 000000" value = "<?php echo $SeriyaNomerPasport; ?>"></p>
                <p>Контактная информация: <input type="text" name = "TbTelephone" pattern = "\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}" placeholder="+7 (000) 000-00-00" value = "<?php echo $ContactInformation; ?>"></p>
                <p>Адрес: <input type="text" name = "TbAdres" value = "<?php echo $Adres; ?>"></p>
                <p>Отдел: <select name="CbAddOtdel">
                        <?php
                            $sql = "select id, Name from otdel";
                            if($result = $conn ->query($sql))
                            {
                                $rowsCount = $result -> num_rows;
                                echo "<option disabled selected>Выберите должность</option>";
                                foreach($result as $row)
                                {
                                    if($row["id"] == $Otdel)
                                        echo "<option value=".$row["id"]." selected>".$row["Name"]."</option>";
                                    else
                                        echo "<option value=".$row["id"].">".$row["Name"]."</option>";
                                }
                                $result ->free();
                            }
                            else
                                echo "Ошибка: ". $conn->error;
                        ?>
                    </select>
                </p>
                <p>Должность: <select name="CbAddDlojnost">
                        <?php
                            $sql = "select id, Name from doljnost";
                            if($result = $conn ->query($sql))
                            {
                                $rowsCount = $result -> num_rows;
                                echo "<option disabled selected>Выберите должность</option>";
                                foreach($result as $row)
                                {
                                    if($row["id"] == $Otdel)
                                        echo "<option value=".$row["id"]." selected>".$row["Name"]."</option>";
                                    else
                                        echo "<option value=".$row["id"].">".$row["Name"]."</option>";
                                }
                                $result ->free();
                            }
                            else
                                echo "Ошибка: ". $conn->error;
                        ?>
                    </select>
                </p>
                <p>Размер зарплаты: <input type="text" name = "TbSalaryAmount" value = "<?php echo $SalaryAmount; ?>"></p>
                <?php if($update): ?>
                    <button type="submit" name="save">Сохранить</button>
                <?php else: ?>
                    <button type="submit" name="add">Добавить</button>
                    <?php endif; ?>
            </Form>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>