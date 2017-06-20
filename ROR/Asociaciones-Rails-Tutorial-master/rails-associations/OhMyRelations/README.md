##CREAR ASOCIACIONES
#### Relación de Uno a Muchos

- Crear DB

<pre>
  rails new OhMyRelations -d mysql
</pre>

- Generar modelo **User**, esto generará una migración llamada "xxxx_create_user".

<pre>
rails g model User name:string
</pre>

- Generar modelo **Post**, esto generará una migración llamada "xxxx_create_post".

<pre>
rails g model Post user:references body:text
</pre>

**user:references** es la forma común de definir una **foreign key** – Esto automáticamente nombrará la columna correspondiente **user&#95;id** y lo indexará en la Post. Dentro de la migración **xxxx_create_post**:

<pre>
  class CreatePosts < ActiveRecord::Migration[5.0]
    def change
      create_table :posts do |t|
        <b>t.references :user, foreign_key: true</b> // Define la foreign key
        t.text :body

        t.timestamps
      end
    end
  end
</pre>

- Luego de crear los modelos **User** y **Post**, deberemos ejecutar las migraciones:

<pre>
  <b>rails db:create</b>
    Created database 'OhMyRelations_development'
    Created database 'OhMyRelations_test'
  <b>rails db:migrate:status</b>
    Schema migrations table does not exist yet.
  <b>rails db:seed</b>
    You have 2 pending migrations:
      20161122013356 CreateUsers
      20161122014137 CreatePosts
      Run `rails db:migrate` to update your database then try again.
      iMac-de-William:OhMyRelations williamromero$ rails db:migrate:status

      database: OhMyRelations_development

       Status   Migration ID    Migration Name
      --------------------------------------------------
        down    20161122013356  Create users
        down    20161122014137  Create posts
  <b>rails db:migrate</b>
    == 20161122013356 CreateUsers: migrating ======================================
    -- create_table(:users)
       -> 0.0866s
    == 20161122013356 CreateUsers: migrated (0.0867s) =============================

    == 20161122014137 CreatePosts: migrating ======================================
    -- create_table(:posts)
       -> 0.0132s
    == 20161122014137 CreatePosts: migrated (0.0132s) =============================  

</pre>

- Si nos fijamos, luego de la migración en el **modelo Post**, al haber hecho una referencia al modelo User en su creación, tendremos dentro del archivo del modelo, la siguiente linea:

<pre>
  class Post < ApplicationRecord
    belongs_to :user
  end
</pre>

- Adicionalmente, en el **modelo User** has de modificar la relación **has_many**.

<pre>
  class User < ApplicationRecord
    has_many :posts
  end
</pre>


- Luego, crear un usuario **usuario** y luego, generaremos un post, que posea el **identificador** del usuario generado. 


<pre>
   User.<b>create</b> name:'usuario_uno'
   =&#62; #&#60;User id: 1, name: "usuario_uno", created_at: "2016-11-22 06:34:09", updated_at: "2016-11-22 06:34:09"&#62;

   User.<b>create</b> name:'usuario_dos'
   =&#62; #&#60;User id: 2, name: "usuario_dos", created_at: "2016-11-22 06:38:09", updated_at: "2016-11-22 06:38:09"&#62;
</pre>


- Podemos revisar la tabla **Users** mediante MySQL:

<pre>
  mysql&#62; select * from users;
</pre>

| id | name        | created_at          | updated_at          |
|----|-------------|---------------------|---------------------|
|  1 | usuario_uno | 2016-11-22 06:34:09 | 2016-11-22 06:34:09 |
|  2 | usuario_dos | 2016-11-22 06:34:09 | 2016-11-22 06:38:09 |

- Luego de crear los usuarios, crearemos un **post** con uno de los usuarios:

<pre>
  @user = <b>User.find_by id: 2</b>
  @posts = <b>@user.posts</b>

  @posts = <b>@user.posts.create body:'Prueba de texto normal', user_id:@user</b>
  (0.2ms)  BEGIN
  SQL (0.5ms)  INSERT INTO `posts` (`user_id`, `body`, `created_at`, `updated_at`) VALUES (2, 'Prueba de texto normal', '2016-11-22 06:55:51', '2016-11-22 06:55:51')
  (1.7ms)  COMMIT
  =&#62; #&#60;Post id: 1, user_id: 2, body: "Prueba de texto normal", created_at: "2016-11-22 06:55:51", updated_at: "2016-11-22 06:55:51"&#62;
</pre>

- Ahora, podemos ver que el post se ha guardado y se ha grabado en el campo userid, la referencia de la tabla User:

<pre>
  mysql> select * from posts;
</pre>

| id | user_id | body                   | created_at          | updated_at          |
|----|---------|------------------------|---------------------|---------------------|
|  1 |       2 | Prueba de texto normal | 2016-11-22 06:55:51 | 2016-11-22 06:55:51 |
|  2 |       1 | Otro texto de prueba   | 2016-11-22 07:01:15 | 2016-11-22 07:01:15 |
|  3 |       1 | Prueba de texto normal | 2016-11-22 07:01:37 | 2016-11-22 07:01:37 |

- Tal cual hemos manejado los modelos mediante consola, podemos realizarlo en los controladores. Pero en lo que respecta al manejo del modelo en consola, pueden utilizarse métodos de búsqueda más rápidos;

<pre>
  @posts = <b>@user.posts.count</b>
  (0.3ms)  SELECT COUNT(*) FROM `posts` WHERE `posts`.`user_id` = 1
  =&#62; 2 
</pre>

<pre>
  @posts = <b>@user.posts.first</b>
  Post Load (0.4ms)  SELECT  `posts`.* FROM `posts` WHERE `posts`.`user_id` = 1 ORDER BY `posts`.`id` ASC LIMIT 1
  =&#62; #&#60;Post id: 2, user_id: 1, body: "Otro texto de prueba", created_at: "2016-11-22 07:01:15", updated_at: "2016-11-22 07:01:15"&#62;
</pre>


### Vínculos:
  [Rails Associations](https://www.sitepoint.com/brush-up-your-knowledge-of-rails-associations/)
  [Rails Associations Polymorphic](https://launchschool.com/blog/understanding-polymorphic-associations-in-rails)
  [Introducing the Rails Active Record belongs_to Association](https://www.youtube.com/watch?v=-fm614dLGBA)
  [User Microposts](https://www.railstutorial.org/book/user_microposts)
