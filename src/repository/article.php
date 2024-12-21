<?php

    require_once("src/model/article.php");

    class ArticleRepository
    {
        private $dbconnect;

        public function __construct($dbconnect)
        {
            $this->dbconnect = $dbconnect;
        }

        public function getAll()
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM BTL_article"
                );


                $statement->execute();
                
                $articles = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $article = new article();
                    $article->code = $row['code'];
                    $article->designation = $row['designation'];
                    $article->description = $row['description'];

                    $articles[] = $article;
                }
                
                return $articles;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($article)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO BTL_article(code,designation,description) 
                    VALUES(:code,:designation,:description)"
                );

                $statement->bindParam(':code',$article->code);
                $statement->bindParam(':designation',$article->designation);
                $statement->bindParam(':description',$article->description);

                $statement->execute();
                                
                return $article;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function update($article)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE BTL_article SET designation = :designation,description = :description 
                    WHERE code = :code"
                );

                $statement->bindParam(':code',$article->code);
                $statement->bindParam(':designation',$article->designation);
                $statement->bindParam(':description',$article->description);

                $statement->execute();
                                
                return $article;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($article)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM BTL_article WHERE code = :code"
                );

                $statement->bindParam(':code',$article->code);

                $statement->execute();
                                
                return $article;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }