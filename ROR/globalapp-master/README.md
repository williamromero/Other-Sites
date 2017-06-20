#SET I18n & GLOBALIZE

Create a Rails app called: **globalapp**
<pre>
  rails new globalapp -d mysql
</pre>

And modify the **config/database.yml** file:
<pre>
  default: &default
  adapter: mysql2
  encoding: utf8
  pool: 5
  username: root
  password: 1234
  socket: /tmp/mysql.sock
</pre>

And later, run the create database command:
<pre>
  rails db:create
</pre>

Add bootstrap to your app:
<pre>
  subl globalapp/Gemfile

  gem 'bootstrap-sass'
</pre>

After that, run **bundle install** commmand on console.

First of all, we need to set the **config/application.rb** file:

<pre>
  subl config/<b>application.rb</b>

  require File.expand_path('../boot', __FILE__)

require 'rails/all'

# Require the gems listed in Gemfile, including any gems
# you've limited to :test, :development, or :production.
Bundler.require(*Rails.groups)

module GlobalTest
  class Application < Rails::Application
    # Set Time.zone default to the specified zone and make Active Record auto-convert to this zone.
    # Run "rake -D time" for a list of tasks for finding time zone names. Default is UTC.
    <b>config.time_zone = 'Central Time (US & Canada)'</b>

    # config.i18n.load_path += Dir[Rails.root.join('my', 'locales', '*.{rb,yml}').to_s]
    <b>config.i18n.default_locale = :es</b>

    # Globalize.fallbacks = {:en => [:en, :es], :es => [:es, :en]}
    <b>config.i18n.available_locales = [:en, :es]</b>

    # Do not swallow errors in after_commit/after_rollback callbacks.
    config.active_record.raise_in_transactional_callbacks = true
  end
</pre>

Now, on the environments files, add the callback action:

<pre>
  subl config/environments/<b>production.rb</b>

  <b>config.i18n.fallbacks = true</b>
</pre>

Now, we will create and start the new application, but first we need to have a model, controller and views for our application.

<pre>
  rails g <b>model Post title:string body:text</b>
  rails g <b>controller Post</b>
</pre>

After create the Post structure, we need to do the last migration which was created:

<pre>
  rails db:migrate RAILS_ENV=development
</pre>

Now, we need to generate the views for all actions but first, create the route to Posts:

<pre>
  subl <b>config/routes.rb</b>

  <b>root 'posts#index'
  resources :posts</b>
</pre>

And after that, we are ready to create views on **Posts Views Folder**:

<pre>
  touch app/views/posts/<b>_form.html.erb</b>
  touch app/views/posts/<b>index.html.erb</b>
  touch app/views/posts/<b>edit.html.erb</b>
  touch app/views/posts/<b>show.html.erb</b>
  touch app/views/posts/<b>new.html.erb</b>
</pre>

Now, inside of those files, we have to create the structure and the **LOCALES texts** which will be syncronized with the **LOCALES YML Files** we will create soon.

To build a link with a **LOCALE** selection, we need to create a nav to put it on our header, and also we need to use a **[link_to_unless_current](http://apidock.com/rails/ActionView/Helpers/UrlHelper/link_to_unless_current)** helper which replaces the text of the link to another link with the name of the option was choossed inside the element.

subl app/views/layouts/<b>application.html.erb</b>

<pre>
  &lt;!DOCTYPE html&gt;
  &lt;html&gt;
    &lt;head&gt;
      &lt;title&gt;Globalapp&lt;/title&gt;
      &lt;%= csrf_meta_tags %&gt;

      &lt;%= stylesheet_link_tag    'application', media: 'all', 'data-turbolinks-track': 'reload' %&gt;
      &lt;%= javascript_include_tag 'application', 'data-turbolinks-track': 'reload' %&gt;
    &lt;/head&gt;
    &lt;body&gt;
      &lt;div class="container"&gt;
        &lt;div class="nav"&gt;
          <b>&lt;%= link_to_unless_current "English", locale: "en" %&gt;</b> |
          <b>&lt;%= link_to_unless_current "Spanish", locale: "es" %&gt;</b>
        &lt;/div&gt;  
        &lt;%= yield %&gt;
      &lt;/div&gt;
    &lt;/body&gt;
  &lt;/html&gt;
</pre>

subl app/views/posts/<b>_form.html.erb</b>

<pre>
  &lt;%= form_for(@post) do |f| %&gt;
    &lt;% if @post.errors.any? %&gt;
      &lt;div id="error_explanation"&gt;
        &lt;h2&gt;&lt;%= pluralize(@post.errors.count, "error") %&gt; prohibited this post from being saved:&lt;/h2&gt;

        &lt;ul&gt;
        &lt;% @post.errors.full_messages.each do |message| %&gt;
          &lt;li&gt;&lt;%= message %&gt;&lt;/li&gt;
        &lt;% end %&gt;
        &lt;/ul&gt;
      &lt;/div&gt;
    &lt;% end %&gt;

    &lt;div class="field"&gt;
      &lt;%= f.label <b>t('posts.form.title')</b> %&gt;&lt;br&gt;
      &lt;%= f.text_field :title %&gt;
    &lt;/div&gt;
     &lt;div class="field"&gt;
      &lt;%= f.label <b>t('posts.form.body')</b> %&gt;&lt;br&gt;
      &lt;%= f.text_area :body %&gt;
    &lt;/div&gt;

    &lt;div class="actions"&gt;
      &lt;%= f.submit %&gt;
    &lt;/div&gt;
  &lt;% end %&gt;

&lt;/pre&gt;
</pre>

subl app/views/posts/<b>index.html.erb</b>

<pre>

  &lt;p id="notice"&gt;&lt;%= notice %&gt;&lt;/p&gt;

  &lt;h1&gt; &lt;%= <b>t('posts.index.mainTitle')</b> %&gt;&lt;/h1&gt;

  &lt;table border="1"&gt;
    &lt;thead&gt;
      &lt;tr&gt;
        &lt;th&gt;&lt;%= <b>t('posts.index.title')</b> %&gt;&lt;/th&gt;
        &lt;th&gt;&lt;%= <b>t('posts.index.body')</b> %&gt;&lt;/th&gt;
        &lt;th colspan="3"&gt;&lt;/th&gt;
      &lt;/tr&gt;
    &lt;/thead&gt;

    &lt;tbody&gt;
      &lt;% @posts.each do |post| %&gt;

      &lt;tr&gt;
        &lt;td&gt;&lt;%= post.title %&gt;&lt;/td&gt;
        &lt;td&gt;&lt;%= post.body %&gt;&lt;/td&gt;

        &lt;td&gt;&lt;%= link_to <b>t('posts.index.btn_show')</b>, post %&gt;&lt;/td&gt;
        &lt;td&gt;&lt;%= link_to <b>t('posts.index.btn_edit')</b>, edit_post_path(post) %&gt;&lt;/td&gt;
        &lt;td&gt;&lt;%= link_to <b>t('posts.index.btn_destroy')</b>, post, method: :delete, data: { confirm: 'Are you sure?' } %&gt;&lt;/td&gt;
        &lt;/tr&gt;
      &lt;% end %&gt;
    &lt;/tbody&gt;
  &lt;/table&gt;

  &lt;br/&gt;
</pre>

subl app/views/posts/<b>show.html.erb</b>

<pre>
  &lt;p id="notice"&gt;&lt;%= notice %&gt;&lt;/p&gt;

  &lt;p&gt;
    &lt;strong&gt;Title:&lt;/strong&gt;
    &lt;%= @post.title %&gt;
  &lt;/p&gt;

  &lt;p&gt;
    &lt;strong&gt;Description:&lt;/strong&gt;
    &lt;%= @post.body %&gt;
  &lt;/p&gt;


  &lt;%= link_to 'Edit', edit_post_path(@post)  %&gt; |
  &lt;%= link_to 'Back', posts_path %&gt;
</pre>

subl app/views/posts/<b>new.html.erb</b>

<pre>
  &lt;h1&gt;&lt;%= <b>t('newPost')</b> %&gt;&lt;/h1&gt;
    &lt;%= render 'form' %&gt;
  &lt;%= link_to 'Back', posts_path %&gt;
</pre>

subl app/views/posts/<b>edit.html.erb</b>

<pre>
  &lt;h1&gt;&lt;%= <b>t('posts.edit.title')</b> %&gt;&lt;/h1&gt;

  &lt;%= render 'form' %&gt;

  &lt;%= link_to 'Show', @post %&gt; |
  &lt;%= link_to 'Back', posts_path %&gt;
</pre>

But now, you could be asking why were its supposed exists texts like: **'Show, delete or Edit'** we changed to a **'t(post.index.title)' SYNTAX**. Right, we create this ones to store the static data inside the **YML** files, which ones, can be ordered to each model, and view, and function. For example:

<pre>
    <b>=&gt; t ('posts.index.title')</b>
  t ('view_name.method_name.name_element')


    <b>=&gt; t ('posts.edit.title')</b>
  t ('view_name.method_name.name_element')
</pre>

And inside our **YML Locale Files** we will map the structure of our page with the same structure but each part inside other one:

<pre>
 ___________________________________________________________________________
|             <b>SPANISH</b>                                <b>ENGLISH</b>               | 
| ------------------------------------- | -------------------------------- |
|  es:                                  |  en:                             |
|    posts:                             |    posts:                        |
|      new:                             |      new:                        |
|        title: Título                  |        title: Title              |
|        body: Cuerpo                   |        body: Body                |
|        newPost: Nuevo Post            |        newPost: New Post         |
|        btn_destroy: Destruir          |        btn_destroy: Delete       |
|      index:                           |    index:                        |
|        title: Título                  |      title: Title                |
|        body: Cuerpo                   |      body: Body                  |
|        mainTitle: Listado de Post     |      mainTitle: List of Posts    |
|        btn_show: Mostrar              |      btn_show: Show              |
|        btn_edit: Editar               |      btn_edit: Edit              |
|        btn_destroy: "Eliminar"        |      btn_destroy: Delete         |
|      form:                            |    form:                         |
|        title: "Título"                |      title: Title                |
|        body: Cuerpo                   |      body: Body                  |
|      edit:                            |    edit:                         |
|        title: "Editar Post"           |      title: Post Title           |
|      show:                            |    show:                         |
|        title: "Título"                |      title: Title                |
|        body: Cuerpo                   |      body: Body                  |
|_______________________________________|__________________________________|
</pre>

But now, if we try to go to the views and run the Rails app and click on the links, we will receive the URL with an anoying style like that:

<pre>
  http://localhost:3000/posts?locale=en
</pre>

So, if we now we don't link this way to display, we have to set some methods:

### Setting Locales

Now, go to **Application Controller** file to add the code which will handle the locale setup.

<pre>
  subl app/controllers/application_controller.rb

  class ApplicationController < ActionController::Base
    protect_from_forgery with: :exception
    <b>before_action :set_locale</b>

    <b>def set_locale</b>
      <b>I18n.locale = params[:locale] if params[:locale].present?</b>
      # current_user.locale
      # request.subdomain
      # request.env["HTTP_ACCEPT_LANGUAGE"]
      # request.remote
    <b>end</b>

    <b>def default_url_options(options = {})</b>
      { locale: I18n.locale }
    <b>end</b>
</pre>

And after create a SCOPE to hide the characters which not describe the **LOCALE** selected:

<pre>
  subl app/config/<b>routes.rb</b>

  <b>scope "(:locale)", locale: /#{I18n.available_locales.join("|")}/ do</b>
      root 'posts#index'
      resources :posts
  <b>end</b>
    
  <b>
    get '*path', to: redirect("/#{I18n.default_locale}/%{path}")
    get '', to: redirect("/#{I18n.default_locale}") 
  </b>

</pre>

### Setting Globalize

The first thing we have to do is install the gem:

<pre>
  gem 'globalize', github: 'globalize/globalize'
  gem 'activemodel-serializers-xml'
</pre>

The second it will add the fields on the Model we need to transalate that will be translated:

<pre>
class Post < ApplicationRecord
  <b>translates :title, :body</b>
end
</pre>

After to install globalize, we have to create the **translated posts table** . thus we need to generate the next migration:

<pre>
  rails g migration CreatePostsTranslations
</pre>

And after that, we have to insert fields we want to translate:

<pre>
  subl app/db/migrate/20170125011344_create_posts_translations.rb

  def change
    reversible do |dir|
      dir.up do
        Post.create_translation_table!({
          <b>:title => :string,</b>
          <b>:body =>  :text</b>
        }, {
          :<b>migrate_data => true</b>
        })
      end

      dir.down do 
        <b>Post.drop_translation_table! :migrate_data => true</b>
      end
    end
  end
</pre>

Next to do that, we have to run the migrations:

<pre>
  rails db:migrate
</pre>

An, READY.

Links:
[i18n](http://guides.rubyonrails.org/i18n.html)
[Translate data](http://danielagattoni.quiltyweb.com/guardar-textos-en-varios-idiomas-en-rails/)
[Globalize data](https://www.sitepoint.com/go-global-rails-i18n/)
[Go global](https://www.sitepoint.com/go-global-rails-i18n/)
[Desafio LATAM](http://blog.desafiolatam.com/guardar-textos-en-varios-idiomas-en-rails/)
[Desafio Latam Github](https://github.com/dgattoni/translateYourPosts/blob/master/app/views/posts/_form.html.erb)
[Rails association](http://guides.rubyonrails.org/association_basics.html)
[Rails 138](https://www.youtube.com/watch?v=kBdZ9_yGLjg)
[Domain locales](http://www.victorareba.com/tutorials/multilingual-application-with-domain-switch-in-rails)
[Translation categories](https://github.com/rdunlop/unicycling-registration/blob/master/app/views/translations/categories/edit.html.haml)
[Make rails multilanguage](http://www.railscarma.com/blog/technical-articles/make-rails-application-multilingual/)
[internationalization_with_globalize](https://www.synbioz.com/blog/internationalization_with_globalize)

