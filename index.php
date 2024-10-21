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
            $conn = new mysqli("localhost", "root", "", "testtask");

            if($conn->connect_error)
            {
                die("Ошибка: " . $conn->connect_error);
            }
            $sql = "SELECT sotrudniki.id, Lastname, Firstname, Middlename, SeriyaNomerPasport, ContactInformation, Address, otdel.Name as OtdelName, doljnost.Name as DoljnostName, SalaryAmount, DateEmployment, Dismissed FROM sotrudniki join otdel on sotrudniki.idOtdela = otdel.id JOIN doljnost on sotrudniki.idDoljnosti = doljnost.id;";
            if($result = $conn -> query($sql))
            {
                $rowsCount = $result -> num_rows;
                echo "<table><tr><th>Код</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Серия/Номер паспорт</th><th>Контактная информация</th><th>Адрес проживания</th><th>Отдел</th><th>Должность</th><th>Размер зарплаты</th><th>Дата принятия на работу</th><th>Статус</th></tr>";
                foreach($result as $row)
                {
                    echo "<tr>";
                        echo "<th>".$row["id"]."</th>";
                        echo "<td>".$row["Lastname"]."</td>";
                        echo "<td>".$row["Firstname"]."</td>";
                        echo "<td>".$row["Middlename"]."</td>";
                        echo "<td>".$row["SeriyaNomerPasport"]."</td>";
                        echo "<td>".$row["ContactInformation"]."</td>";
                        echo "<td>".$row["Address"]."</td>";
                        echo "<td>".$row["OtdelName"]."</td>";
                        echo "<td>".$row["DoljnostName"]."</td>";
                        echo "<td>".$row["SalaryAmount"]."</td>";
                        echo "<td>".$row["DateEmployment"]."</td>";
                        echo "<td>".$row["Dismissed"]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                $result ->free();
            }
            else
                echo "Ошибка: ". $conn->error;
        ?>
        <div class = "BlockFilter">
            <b>Фильтрация</b><br>
            <p>Отдел:
                <select>
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
                <select>
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
            
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>