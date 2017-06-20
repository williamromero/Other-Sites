class AddFiedsOnArticles < ActiveRecord::Migration[5.0]
  def change
    add_column :articles, :title,   :string
    add_column :articles, :posts,   :text
    add_column :articles, :counter, :integer
  end
end
