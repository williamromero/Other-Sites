class AddFieldsToPosts < ActiveRecord::Migration[5.0]
  def change
    add_column :posts, :title, :string
    add_column :posts, :body, :string
    add_column :posts, :description, :string
    add_column :posts, :slug, :string
  end
end
