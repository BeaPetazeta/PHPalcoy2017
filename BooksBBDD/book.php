<?php 
	
	//aqui hago una variable en la que me guardo lo que hay en el archivo config
	$config = include "config.php";
	//despues de que nos return lo que hay dentro del archivo config.php, ahora guardo en una variable $db los campos del array quetiene dicho archivo
	$db = $config["db"];

	class Book //las clases se escriben con mayúscula

	{
		private $book_id; //para que sea de tipo de privado, le ponemos delante private
		private $title;
		private $author;
		private $description;

	
		//creamos la funcion constructor que es el que le pasará por defecto los valores al nuevo objeto
		function __construct($autor, $titulo, $descripcion){
			//ahora le digo con el this que la variable de la clase tendrá el valor que reciba
			$this->title = $titulo;
			$this->author = $autor;
			$this->description = $descripcion;
		}

		//como las variables que hemos declarado, son de tipo privado, lo cual nos impide cambiar su valor una vez creadas, ahora haremos la función set para cada variable por si quisiéramos modificar su valor

		function setId ($identificador){
			$this->book_id = $identificador;
		}

		function setTitle ($titulo){
			$this->title = $titulo;
		}

		function setAuthor ($autor){
			$this->author = $autor;
		}

		function setDescription ($descripcion){
			$this->description = $descripcion;
		}

		//ahora haremos la función get para poder extraer el valor que queramos de la variable

		function getId (){
			return $this->book_id;
		}

		function getTitle (){
			return $this->title;
		}

		function getAuthor (){
			return $this->author;
		}

		function getDescription (){
			return $this->description;
		}

		static function connection(){
			//como la variable $db la hemos creado arriba del todo como una variable global, la tenemos que incluir para que la funcion pueda utilizarla 
			global $db;
			return new PDO(
				//aqui estamos tirando de los campos de $config que hemos guardado al principio en la variable $db 
				"mysql:host={$db['host']};
				dbname={$db['dbname']};
				charset={$db['charset']}",
				$db['user'],
				$db['password']
			);
		}
		//esta función nos devuelve todos los libros almacenados
		static function getAll(){
			$filas = self::connection()->query('SELECT * FROM books')->fetchAll();
			$colection = [];
		foreach ($filas as $book) {
			$new_book = new Book($book["title"], $book["author"], $book["description"]);
			$new_book->id = $book["books_id"];
			$colection[]=$new_book;
		}
		return $colection;
		}
		//en esta en cambio nos devuelve la información de un sólo libro, el cual le pasamos nosotros el id
		static function find($book_id){
			//hacemos la consulta
			$consulta = self::connection()->query("SELECT * FROM books WHERE id='{$book_id}'")->fetch;
			$book = new Book($consulta["titulo"], $consulta["autor"], $consulta["descripcion"]);
			$book->id = $consulta["book_id"];
			return $book;
		}
	}
//Aqui acaba la clase book
	$books = Book::getAll();
	var_dump($books);
?>