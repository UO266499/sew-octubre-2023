
<?php

class BaseDeDatos
{ 
    private $username;
    private $password;
    private $server;
    private $db;
    private $user_id;
    private $ultimaFecha;

    public function __construct(){
        $this->username = "DBUSER2023";
        $this->password = "DBPSWD2023";
        $this->server = "localhost";
        $this->db = "reservas";
    }

    public function inicializarBD(){

    // Local

    //$connection = new mysqli($this->server, $this->username, $this->password, $this->db);

    // Servidor
     $this->connection = mysqli_init();
     mysqli_ssl_set($this->connection,NULL,NULL, "./DigiCertGlobalRootCA.crt.pem", NULL, NULL);
     mysqli_real_connect($this->connection, "reservas.mysql.database.azure.com", "adminsew", "test123...", "reservas", 3306, MYSQLI_CLIENT_SSL);   

    $query = "CREATE TABLE IF NOT EXISTS users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL
    );";
    $connection->query($query);


    $query = "CREATE TABLE IF NOT EXISTS tourist_resources (
        resource_id INT PRIMARY KEY,
        resource_name VARCHAR(100) NOT NULL,
        location VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        type VARCHAR(50) NOT NULL,
        description VARCHAR(500) NOT NULL,
        availability INT NOT NULL
    );";
    $connection->query($query);

        $query = "CREATE TABLE IF NOT EXISTS reservations (
            reservation_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            resource_id INT NOT NULL,
            trip_date DATE NOT NULL,
            trip_time TIME NOT NULL,
            trip_date_end DATE NOT NULL,
            trip_time_end TIME NOT NULL,
            total_cost DECIMAL(10,2) NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(user_id),
            FOREIGN KEY (resource_id) REFERENCES tourist_resources(resource_id)
        );";
        $connection->query($query);

        $query = "CREATE TABLE IF NOT EXISTS payments (
            payment_id INT AUTO_INCREMENT PRIMARY KEY,
            reservation_id INT NOT NULL,
            payment_method VARCHAR(50) NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            FOREIGN KEY (reservation_id) REFERENCES reservations(reservation_id)
        );";
        $connection->query($query);

        $query = "CREATE TABLE IF NOT EXISTS reviews (
            review_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            resource_id INT NOT NULL,
            rating INT NOT NULL,
            comments VARCHAR(500),
            FOREIGN KEY (user_id) REFERENCES users(user_id),
            FOREIGN KEY (resource_id) REFERENCES tourist_resources(resource_id)
        );";
    $connection->query($query);

    $queryData = $connection->prepare("INSERT IGNORE INTO tourist_resources (resource_id,resource_name,location,price,type,description,availability) VALUES (?,?,?,?,?,?,?)"); 

    $id = 0;
    $name = 'Museo historia de Armenia';
    $location = 'Erevan';
    $price = 7;
    $type = 'Museo';
    $description = 'Museo de la historia de Armenia situado en Erevan';
    $availability = 80;

    $queryData->bind_param("ississi",$id,$name,$location,$price,$type,$description,$availability);
    
    $queryData ->execute();

    $id = 1;
    $name = 'Cafesjian centro de las artes';
    $location = 'Erevan';
    $price = 3;
    $type = 'Museo';
    $description = 'Mas un museo que una trienda, contiene numerosas obras de arte';
    $availability = 20;

    $queryData ->execute();

    $id = 2;
    $name = 'Museo Ervand Kochar';
    $location = 'Erevan';
    $price = 0;
    $type = 'Museo';
    $description = 'Museo del artista y escultor Ervand Kochar';
    $availability = 1;

    $queryData ->execute();

    $id = 3;
    $name = 'EVN Diner';
    $location = 'Erevan';
    $price = 15;
    $type = 'Restaurante';
    $description = 'Comida mexicana y americana';
    $availability = 75;

    $queryData ->execute();

    $id = 4;
    $name = 'Syrovarnya Yerevan';
  $location = 'Erevan';
    $price = 18;
    $type = 'Restaurante';
    $description = 'Comida tipica Armenia';
    $availability = 50;

    $queryData ->execute();

    $id = 5;
    $name = 'Lahmajun Gaidz';
    $location = 'Erevan';
    $price = 16;
    $type = 'Restaurante';
    $description = 'Comida rápida al estilo Armenio';
    $availability = 30;

    $queryData ->execute();

    $id = 6;
    $name = 'Dari Pandok';
    $location = 'Erevan';
    $price = 13;
    $type = 'Restaurante';
    $description = 'Barbacoa europea con estilo Armenio';
    $availability = 45;

    $queryData ->execute();

    $id = 7;
    $name = 'ibis Yerevan Center';
    $location = 'Erevan';
    $price = 35;
    $type = 'Hotel';
    $description = 'Una opción mas asequible para visitar lowcost';
    $availability = 20;

    $queryData ->execute();

    $id = 8;
    $name = 'Ibis Yerevan Center';
    $location = 'Erevan';
    $price = 45;
    $type = 'Hotel';
    $description = 'Hotel centrico en Erevan';
    $availability = 30;

    $queryData ->execute();

    $id = 9;
    $name = 'Ani Grand Hotel Yerevan';
    $location = 'Erevan';
    $price = 100;
    $type = 'Hotel';
    $description = 'Hotel con spa completo y todo tipo de lujos';
    $availability = 40;

    $queryData ->execute();
    $connection->close();
}

public function crearCuenta(){
    $connection = new mysqli($this->server,$this->username,$this->password,$this->db);
    $queryData = $connection->prepare("INSERT INTO users (user_id,username,password,email) VALUES (?,?,?,?)");
    if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])){
        echo "<p> Alguno de los campos no ha sido rellenado </p>";
    }else{
        $query = $connection->query("SELECT COUNT(*) from users WHERE username = '" . $_POST["username"] ."'");
        if($query->fetch_row()[0] != 0){
            echo "<p>Ya existe una cuenta con ese usuario</p>";
        }else{
        $randomId = rand();
        $queryData->bind_param('isss',$randomId,$_POST["username"],$_POST["password"],$_POST["email"]);
        $queryData->execute();
        echo "<p>Cuenta anadida correctamente</p>";
        }
    }
    $connection->close();
}

public function inicioSesion(){
    $connection = new mysqli($this->server,$this->username,$this->password,$this->db);
    $query = $connection->query("SELECT COUNT(*) from users WHERE username = '" . $_POST["username2"] ."' AND password = '" . $_POST["password2"] ."'");
    if($query->fetch_row()[0] == 0){
        echo "<p>No existe esta cuenta</p>";
    }else{
        $query = $connection->query("SELECT user_id from users WHERE username = '" . $_POST["username2"] ."' AND password = '" . $_POST["password2"] ."'");
        $_SESSION['user_id'] = $query->fetch_row()[0];
        echo "<p>Bienvenido " . $_POST["username2"] . ", haga click en el enlace inferior para acceder a los recursos turisticos.</p>";
        echo '<a href="reservar.php" title="Iniciar busqueda de reservas">Buscar recursos turisticos a reservar</a>';
    }
    
    $connection->close();
}

public function mostrarRecursos(){
    $connection = new mysqli($this->server,$this->username,$this->password,$this->db);
    if(empty($_POST["fecha"]) || empty($_POST["time"]) || empty($_POST["fechaF"]) || empty($_POST["timeF"])){
        echo "<p> Se debe seleccionar una fecha y hora antes de buscar </p>";
    }else{
        $fecha = $_POST["fecha"];
        $_SESSION['fecha'] = $fecha;
        $time = $_POST["time"];
        $_SESSION['time'] = $time;
        $fechaF = $_POST["fechaF"];
        $_SESSION['fechaF'] = $fechaF;
        $timeF = $_POST["timeF"];
        $_SESSION['timeF'] = $timeF;
        $query = $connection->query("SELECT * from tourist_resources");
        
        echo "<form action='#' method='post' id=reserva>";

        while ($row = $query->fetch_row()){
            $capacidadActual = $connection->query("SELECT COUNT(*) FROM reservations where trip_date ='".$fecha."'AND trip_time ='".$time."' AND resource_id ='".$row[0]."'");
            $capacidad = $capacidadActual->fetch_row()[0];
            $review = $connection->query("SELECT AVG(rating) from reviews WHERE resource_id = " . $row[0]);
            echo "<h3>" . $row[1]. "</h3>";
            echo "<p> Ciudad: " . $row[2]. "</p>";
            echo "<p>Valoracion media: ". round($review->fetch_row()[0],4). "</p>";
            echo "<p>Precio: ".$row[3]. "€</p>";
            echo "<p>Tipo: ". $row[4]. "</p>";
            echo "<p>Descripcion: ". $row[5]. "</p>";
            echo "<p>Capacidad: ".$capacidad ."/". $row[6] . "</p>";
            echo '<label for="'.$row[0].'">Marcar para reservar</label>';
            if($capacidad == $row[6]){
                echo '<input type="checkbox" id="'.$row[0].'" name="'.$row[0].'" disabled/>';
            }else{
            echo '<input type="checkbox" id="'.$row[0].'" name="'.$row[0].'"/>';
            }
            
        }

        echo '<label for="metodoDePago">Metodo de pago:</label>
        <select id="metodoDePago" name="metodoDePago">
        <option value="efectivo">Efectivo</option>
        <option value="tarjeta">Tarjeta</option>
        <option value="bizum">Bizum</option>
      </select>';
        echo "<button type='submit' name='reservar'> Realizar reservas </button>";
        echo "</form>";
    }
}

public function verReservas(){
    $connection = new mysqli($this->server,$this->username,$this->password,$this->db);
    echo "<h2> Mis reservas </h2>";
    echo "<p> En la siguiente sección se muestran las reservas realizadas hasta ahora. </p>";
    $query = $connection->query("SELECT * from reservations WHERE user_id= " . $_SESSION['user_id'] . " ORDER BY  trip_date, trip_time ASC ");
    while ($row = $query->fetch_row()){
        $resource = $connection->query("SELECT * from tourist_resources WHERE resource_id= " . $row[2]);
        while ($rowResource = $resource->fetch_row()){
            $isReviewed = $connection->query("SELECT * from reviews WHERE resource_id = " . $rowResource[0] . " AND user_id =" .$_SESSION['user_id']);
            $rowIsReviewed = $isReviewed->fetch_row();
            $paymentMethod = $connection->query("SELECT payment_method from payments WHERE reservation_id = " . $row[0]);
            $initDate =DateTime::createFromFormat('Y-m-d',$row[3]);
            $finDate = DateTime::createFromFormat('Y-m-d',$row[5]);
            if($rowIsReviewed == null){
                echo "<form action='#' method='post'>";
                echo "<h3>" . $rowResource[1] . "</h3>";
                echo "<p>Fecha inicio: ". $row[3]." ".$row[4]. "</p>";
                echo "<p>Fecha fin: ". $row[5]." ".$row[6]. "</p>";
                echo "<p>Precio: ".intval($rowResource[3],10) *( $initDate->diff($finDate)->days + 1)  ."</p>";
                echo "<p>Metodo de pago: " . $paymentMethod->fetch_row()[0] ."</p>";
                echo '<label for="'.$rowResource[0].'">Reseña:</label>';
                echo '<input type="number" id="'.$rowResource[0].'" name="'.$rowResource[0].'" min="1" max="5"/>';
                echo '<label for="comentario'.$rowResource[0].'">Comentarios:</label>';
                echo '<input type="text" id="comentario'.$rowResource[0].'" name="comentarios" />';
                echo "<button type='submit' name='resena'> Enviar reseña </button>";
                echo "</form>";
            }else{
                echo "<h3>" . $rowResource[1] . "</h3>";
                echo "<p>Fecha inicio: ". $row[3]." ".$row[4]. "</p>";
                echo "<p>Fecha fin: ". $row[5]." ".$row[6]. "</p>";
                echo "<p>Precio: ".intval($rowResource[3],10) *( $initDate->diff($finDate)->days + 1)  ."</p>";
                echo "<p>Metodo de pago:" . $paymentMethod->fetch_row()[0]."</p>";
                echo '<label for="'.$rowResource[0].'">Reseña:</label>';
                echo  '<input type="number" id="'.$rowResource[0].'" name="'.$rowResource[0].'" value="'.$rowIsReviewed[3].'"disabled/>';
                echo '<label for="comentario'.$rowResource[0].'">Comentarios:</label>';
                echo '<input type="text" id="comentario'.$rowResource[0].'" name="comentarios" value="'.$rowIsReviewed[4] .'" disabled/>';   
            }
        }
    }
}

public function reservar(){
    $connection = new mysqli($this->server,$this->username,$this->password,$this->db);
    $metodo = $_POST['metodoDePago'];
    $valido = true;
    $fecha = $_SESSION['fecha'];
    $hora = $_SESSION['time'];
    foreach($_POST as $key => $value){
        if($key != 'reservar' && $key != 'metodoDePago'){
            $dateInicial = DateTime::createFromFormat('Y-m-d', $_SESSION['fecha']);
            $dateFinal = DateTime::createFromFormat('Y-m-d', $_SESSION['fechaF']);
            while(!($dateInicial == $dateFinal)){
                $currentDate =  date_format($dateInicial,'Y-m-d');
                $queryAmount = $connection->query("SELECT COUNT(*) FROM  reservations WHERE trip_date='$currentDate' AND trip_time='$hora'"); 

                $query = $connection->query("SELECT availability FROM tourist_resources where resource_id = ". $key );

                $availability = $query->fetch_row()[0];
                $numberOfReservations = $queryAmount->fetch_row()[0];
                if ($numberOfReservations == $availability){
                    $valido = false;
                    echo "Ya existen reservas para estas fechas";
                }
                $dateInicial->modify('+1 day');
            }
        }
    }
    if ($valido){
    foreach($_POST as $key => $value){
        if($key != 'reservar' && $key != 'metodoDePago'){
            $queryData = $connection->prepare("INSERT INTO reservations (reservation_id,user_id,resource_id,trip_date,trip_time, trip_date_end, trip_time_end,total_cost) VALUES (?,?,?,?,?,?,?,?)"); 
            $query = $connection->query("SELECT price FROM tourist_resources where resource_id = ". $key );

            $id= 0;
            $user_id = $_SESSION['user_id'];
            $resource_id = $key;
            $date = $_SESSION['fecha'];

            $date1 = new DateTime( $_SESSION['fecha']);
            $date2 = new DateTime( $_SESSION['fechaF']);
            $interval = $date1->diff($date2);
            $days = intval($interval->days) + 1;
            if ($days === 0){
                $days = 1;
            }

           
            $price = round($query->fetch_row()[0] * ($days ));
            $dateF = $_SESSION['fechaF'];
            $time = $_SESSION['time'];
            $timeF = $_SESSION['timeF'];
    
            $queryData->bind_param("iiissssd",$id,$user_id,$resource_id,$date,$time,$dateF,$timeF,$price);
            
            $queryData ->execute();

            $reservation_id = $connection->query("SELECT reservation_id FROM reservations where resource_id = ". $resource_id ." AND user_id=" . $_SESSION['user_id']." AND trip_date='" . $date ."' AND trip_time= '" . $time ."'"   );

            $connection->query("INSERT INTO payments (payment_id,reservation_id,payment_method,amount) VALUES (". 0 .",".$reservation_id->fetch_row()[0].",'".$metodo."',".$price.")");
        }
    }
    $query = $connection->query("SELECT SUM(total_cost) FROM reservations where user_id = ". $_SESSION['user_id'] );
    echo "Coste total de reservas: " . $query->fetch_row()[0];
}
}

public function hacerResena(){
    $connection = new mysqli($this->server,$this->username,$this->password,$this->db);
    foreach($_POST as $key => $value){
        if($key != 'resena' && $key != 'comentarios'){
            $queryData = $connection->prepare("INSERT INTO reviews (review_id,user_id,resource_id,rating,comments) VALUES (?,?,?,?,?)"); 
            $review_id = 0;
            $user_id = $_SESSION['user_id'];
            $resource_id = $key;
            $rating = $value;
            $comments = $_POST['comentarios'];
            $queryData->bind_param("iiiis",$review_id ,$user_id,$resource_id,$rating,$comments);
            $queryData ->execute();
        }
    }
}
}
