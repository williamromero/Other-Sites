class ArticlesController < ApplicationController
  #GET /articles
  def index
    @articles = Article.all # Las variables de clase inician con una @
    #Obtiene todos los registros de la tabla ARTICLE
  end

  #GET /articles/:id
  def show
    @article = Article.find(params[:id]) # params = Es un hash con todos los elementos que se mandan
    # OTRA FORMA DE BUSCAR EL PARAMETRO PARAMS UTILIZANDO WHERE, SIN LA AYUDA DEL ACTIVE RECORD
      ## Selecciona todos los que no tienen como ID el número 1
      ## Article.where.not("id LIKE ?", 1)
      ## Selecciona todos los que cumplan con el id y el title requerido
      ## Article.where(" id = ? AND title = ?", params[:id], params[:title])
      ## Selecciona todos menos el que el ID sea 1
      ## Article.where.not("id LIKE ?", 1)

      # INTERPOLACIÓN DE CADENAS = string+variable
      # Esta opción es quizás la más peligrosa debido a que es posible sufrir un SQL Injection
      # Article.where("id = #{params[:id]}")
    #
  end

  #GET /articles/new
  def new
    @article = Article.new
  end

  #POST /articles
  def create
    @article = Article.new(title: params[:article][:title],
                           body: params[:article][:body])

    if @article.save
      redirect_to @article 
      # flash[:success] = "Post agregado."
      # render :index
    else
      flash[:danger] = "Este post no ha sido agregado."
      render :new
    end
  end

  def destroy
    @article = Article.find(params[:id])
    @article.destroy
    redirect_to articles_path
  end

  def update

  end
end
