## BLOGSITE WEB TUTORIAL - ESP

* Crear aplicación desde terminal:

<pre>
  rails new <b>blogsite -d mysql</b>
</pre>

* Configurar el archivo de la base de datos de MySQL:

<pre>
  nano blogsite/config/<b>database.yml</b>

  default: &default
    adapter: mysql2
    encoding: utf8
    pool: 5
    username: <b>root</b>       <b>Modificar username y contraseña</b>
    password: <b>1234</b>       <b>mysql local </b>
    host: localhost

  development:
    &#60;&#60;: *default
    database: blogsite_development
  test:
    &#60;&#60;: *default
    database: blogsite_test
  production:
    &#60;&#60;: *default
    database: blogsite_production
    username: blogsite
    password: &#60;%= ENV['BLOGSITE_DATABASE_PASSWORD'] %&#62;
</pre>

* Crear las bases de datos con el comando **rake db:create**; tener claro si el servicio de DB está encendido,
de lo contrario, utilizar el comando **'mysql.server start'**.

<pre>
  iMac-de-William:blogsite williamromero$ <b>rake db:create</b>
  Created database <b>'blogsite_development'</b>
  Created database <b>'blogsite_test'</b>
</pre>

### Instalar Gemas:

*  En primer lugar, deberemos de instalar [Bootstrap](https://github.com/twbs/bootstrap-rubygem) para facilitar creación de las vistas:

<pre>
  nano blogsite/Gemfile
    # Use Bootstrap 4.0.0 for stylesheets
    gem <b>'bootstrap', '~> 4.0.0.alpha4'</b>
</pre>

* Verificar que la versión de la gema **sprockets-rails** es mayor a la **v2.3.2**. De ser así, regresar a **Terminal** e ingresar el comando:

<pre>
  <b>bundle install</b>
</pre>

* Luego, importar la hoja de estilos de bootstrap al archivo principal de estilos de la aplicación, pero antes, cambiarle la extensión de **css** a **scss**:

<pre>
  <b>mv app/assets/stylesheets/application.css app/assets/stylesheets/application.scss</b>
</pre>

* Ahora si importamos la hojas de estilos:

<pre>
    nano <b>app/assets/stylesheets/application.scss</b>
    *= require_self
    */

    <b>@import 'bootstrap';</b>
</pre>

* También, requerir los atributos y métodos de **Javascript**:

<pre>
    nano <b>app/assets/javascripts/application.js</b>

    //= require jquery
    //= <b>require bootstrap-sprockets</b>
    //= require jquery_ujs
    //= require turbolinks
    //= require_tree .
</pre>

### Creación del Modelo POST:

* Luego debemos de generar el modelo **Post**, controlador y vistas:

<pre>
  rails generate <b>model Post</b>

  Running via Spring preloader in process 20491
      invoke  active_record
      create    db/migrate/20161013020042_create_posts.rb
      create    app/models/post.rb
      invoke    test_unit
      create      test/models/post_test.rb
      create      test/fixtures/posts.yml
</pre>

* Esto, generará los archivos que necesitamos para crear el modelo en cuestión, así como también una **migración**, la cual es una característica del **Active Record** que permite evolucionar el esquema de la base de datos mediante modificaciones **SQL**. En ella, vendrá por añadidura de nuestro generador, el siguiente código, el cual solicitará una migración que genere la tabla que vamos a utilizar:

<pre>
  class CreatePosts < ActiveRecord::Migration[5.0]
    def change
      create_table :posts do |t|

        t.timestamps
      end
    end
  end
</pre>

* Aunque en este archivo no se describe la creación de un campo índice **ID**, el mismo se creará automáticamente.

### Generar migración del Modelo POST:

* Generar la migración para crear los campos de nuestro modelo **Post**:

<pre>
  rails generate <b>migration add_fields_to_post</b>

  Running via Spring preloader in process 20520
      invoke  active_record
      create    db/migrate/20161013020347_add_fields_to_post.rb
</pre>

* Acceder a la migración de nuestro model post, para crear los campos que se crearán en la tabla del mismo:

<pre>
  nano <b>app/db/20161013020347_add_fields_to_post.rb</b>

  class AddFieldsToPosts < ActiveRecord::Migration[5.0]
    def change
    end
  end
</pre>

* Dentro de este archivo y su método **change**, colocar los campos que vamos a requerir:

<pre>
  class AddFieldsToPosts < ActiveRecord::Migration[5.0]
    def change
      add_column :posts, :title, :string
      add_column :posts, :body, :string
      add_column :posts, :description, :string
      add_column :posts, :slug, :string
    end
  end
</pre>

* Ahora, para que ocurra la alteración de la DB, se debe de generar la migración mediante los siguientes comandos:

<pre>
  rails <b>db:seed</b>

    You have 2 pending migrations:
      20161013020042 CreatePosts
      20161013020347 AddFieldsToPost
</pre>
<pre>
  rails <b>db:migrate:status</b>

    database: blogsite_development

     Status   Migration ID    Migration Name
    --------------------------------------------------
      down    20161013020042  Create posts
      down    20161013020347  Add fields to post
</pre>
<pre>
  rails <b>db:migrate</b>

  == 20161013020042 CreatePosts: migrating ======================================
  -- create_table(:posts)
     -> 0.0190s
  == 20161013020042 CreatePosts: migrated (0.0191s) =============================

  == 20161013020347 AddFieldsToPosts: migrating =================================
  -- add_column(:posts, :title, :string)
     -> 0.0141s
  -- add_column(:posts, :body, :string)
     -> 0.0138s
  -- add_column(:posts, :description, :string)
     -> 0.1032s
  -- add_column(:posts, :slug, :string)
     -> 0.0495s
  == 20161013020347 AddFieldsToPosts: migrated (0.1808s) ========================
</pre>

### Utilizando la Rails Console

* Luego de crear la tabla y las columnas que vamos a utilizar, podemos ingresar a la **consola de Rails** mediante el siguiente comando y crear ya, el primer registro:

##### Método NEW
<pre>
  rails <b>console</b>
  Post.<b>connection</b>
  Posts = Post.new    <b>El método 'NEW' crea una posición vacía para rellenar, por eso su valor es 'nil'</b>
  =&#62; #&#60; Post id: nil, created_at: nil, updated_at: nil, title: nil, body: nil, description: nil, slug: nil &#62;

  Posts.title =       <b>'First Post'</b>
  Posts.body =        <b>'Some content for the first post'</b>
  Posts.description = <b>'Information, Techonology'</b>
  Posts.slug =        <b>'Technology'</b>
  Posts.<b>save</b>   <b>El método 'SAVE' guarda el registro en la posición creada.</b>

  O también podemos crear un registro con el comando <b>'CREATE'</b> dentro del cual se genera la acción de creación y de salvar al mismo tiempo que se realiza la sentencia:
</pre>

##### Método CREATE
<pre>
  Post.<b>create</b> title:'Titulo Dos', body:'Contenido para título dos', description:'Contenido', slug:'Arte'
  
  (0.4ms)  BEGIN
  SQL (0.3ms)  INSERT INTO `posts` (`created_at`, `updated_at`, `title`, `body`, `description`, `slug`) VALUES ('2016-10-13 06:38:13', '2016-10-13 06:38:13', 'Titulo Dos', 'Contenido para título dos', 'Contenido', 'Arte')
  (0.9ms)  COMMIT
  =&#62; #&#62;Post id: 4, created_at: "2016-10-13 06:38:13", updated_at: "2016-10-13 06:38:13", title: "Titulo Dos", body: "Contenido para título dos", description: "Contenido", slug: "Arte"&#60; 
</pre>

##### Método CREATE
<pre>
  Post.<b>create</b> title:'Titulo Dos', body:'Contenido para título dos', description:'Contenido', slug:'Arte'
  
  (0.4ms)  BEGIN
  SQL (0.3ms)  INSERT INTO `posts` (`created_at`, `updated_at`, `title`, `body`, `description`, `slug`) VALUES ('2016-10-13 06:38:13', '2016-10-13 06:38:13', 'Titulo Dos', 'Contenido para título dos', 'Contenido', 'Arte')
  (0.9ms)  COMMIT
  =&#62; #&#62;Post id: 4, created_at: "2016-10-13 06:38:13", updated_at: "2016-10-13 06:38:13", title: "Titulo Dos", body: "Contenido para título dos", description: "Contenido", slug: "Arte"&#60;
</pre>

##### Metodo FIND
* Esta sentencia imprime un elemento en específico:

<pre>
  Posts.<b>find(3)</b>
  Post Load (0.3ms)  SELECT  `posts`.* FROM `posts` WHERE `posts`.`id` = 3 LIMIT 1
  =&#62; #&#60;Post id: 3, created_at: "2016-10-13 04:38:39", updated_at: "2016-10-13 04:38:39", title: "Title one", body: "Body one", description: "Different information", slug: "Titulo bueno" &#62;
</pre>

##### Metodo WHERE
* Esta sentencia imprime todas las coincidencias:

<pre>
  Posts = Post.<b>where title:'Title one'</b>
  Post Load (0.3ms)  SELECT `posts`.* FROM `posts` WHERE `posts`.`title` = 'Title one'
  =&#62; ##&#60;ActiveRecord::Relation [#&#60;Post id: 3, created_at: "2016-10-13 04:38:39", updated_at: "2016-10-13 04:38:39", title: "Title one", body: "Body one", description: "Different information", slug: "Titulo bueno"&#62;]&#62;
</pre>

##### Metodo FIND_BY
* Esta sentencia imprime la primera coincidencia:

<pre>
  Posts = Post.<b>find_by title:'Title one'</b>
  Post Load (0.3ms)  SELECT `posts`.* FROM `posts` WHERE `posts`.`title` = 'Title one'
  =&#62; ##&#60;ActiveRecord::Relation [#&#60;Post id: 3, created_at: "2016-10-13 04:38:39", updated_at: "2016-10-13 04:38:39", title: "Title one", body: "Body one", description: "Different information", slug: "Titulo bueno"&#62;]&#62;
</pre>

##### Metodo DESTROY
* Esta sentencia elimina borra objetos de la tabla:

<pre>
  Posts = Post.where title:'Title one'
  Posts = Post.<b>destroy</b>

  Posts = Post.<b>destroy_all</b>
</pre>

### Generar migración del Controlador POST:

* Para generar el controlador del modelo en cuestión, utilizaremos el siguiente comando, el cúal, creará todos los elementos que corresponden al mismo. 

* A diferencia de la creación de un modelo, el **controlador** debe de nombrarse **EN PLURAL** .

<pre>
  rails g controller <b>posts</b>

  Running via Spring preloader in process 1775
      create  app/controllers/posts_controller.rb
      invoke  erb
      create    app/views/posts
      invoke  test_unit
      create    test/controllers/posts_controller_test.rb
      invoke  helper
      create    app/helpers/posts_helper.rb
      invoke    test_unit
      invoke  assets
      invoke    coffee
      create      app/assets/javascripts/posts.coffee
      invoke    scss
      create      app/assets/stylesheets/posts.scss
</pre>

* Esto creará todos los elementos necesarios para generar un entorno de creación de los métodos y sus funciones.

<pre>
  nano app/controlers/<b>posts.erb</b>
</pre>


*Este, contendrá dentro de su estructura, el siguiente script principal en el que se hace referencia de que nuestro controlador, proviene de la clase **ApplicationController**, el cual comenzaremos a llenar para listar los métodos que se verán como rutas luego de su codificación.

<pre>
  class <b>PostsController &#60; ApplicationController</b>
    def index
    end
  end
</pre>

* Aquí es donde se crearán los métodos que llamarán a las vistas que vamos a utilizar:

<pre>
  class PostsController < ApplicationController
    before_action :set_post, only:[:show, :edit, :update, :destroy]
    <b>def index</b>
    <b>end</b>
  end
</pre>

* Pero al iniciar el servidor de aplicaciones de nuevo, habrá otro problema producido por **"el generador de controladores"**, el cual ha creado los **folders** del controlador respectivo pero sin **ningún archivo interno** (los css & js si fueron creados. Por lo tanto para crear las **vistas** que se le requieren al **controlador**, se deberá de ingresar en el **directorio del controlador** en desarrollo y luego se deberá crear un archivo dentro del mismo, con el **nombre del método** que responde a la ruta requerida.

#### Para seguir aprendiendo: 
[Código Facilito - Strong params](https://youtu.be/hJdvGxol96I?list=PLpOqH6AE0tNiQ-ofrDlbAUSc1r67r_AWv) |
[TechmakerTV - How to build a blog with Rails 5 and Bootstrap 4](https://www.youtube.com/watch?v=VpNBCpAgEsY&list=PLjItgYqIzJ9XuCqSsMbolBjLPd-5pA9xj&index=1) |
[Github William Romero - Platzi Rails Course](https://github.com/williamromero/platzi-rails-course/blob/master/README.md) |


___
### RECURSOS DE INFORMACIÓN

[Techmaker Site](http://www.techmaker.tv/chapters/main-694fce03-fbc5-4b7b-aaaa-eda600dc2b7c/lessons/getting-set-up-8290777f-a004-4cf7-a8cb-6e04b11bb5e4) | 
[YouTube Video Reference](https://www.youtube.com/watch?v=VpNBCpAgEsY&list=PLjItgYqIzJ9XuCqSsMbolBjLPd-5pA9xj&index=1) | 
[Add id column in migration](http://stackoverflow.com/questions/12548746/add-id-column-in-a-migration) |
[Active Record Migration](http://edgeguides.rubyonrails.org/active_record_migrations.html)

### RECURSOS DE FRIENDLY URLS

Evaluar los siguientes links:

[Method model_name](http://api.rubyonrails.org/classes/ActiveModel/Naming.html#method-i-model_name) |
[Friendly URLS](http://danielagattoni.quiltyweb.com/crear-url-friendly-en-ruby-on-rails-en-5-pasos/#comment-51) |
[to_params Uses](http://apidock.com/rails/ActiveRecord/Integration/to_param)
