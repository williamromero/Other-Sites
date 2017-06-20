class RenameArticlesNameField < ActiveRecord::Migration[5.0]
  def change
    rename_column :articles, :posts, :body
  end
end
