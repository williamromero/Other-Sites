class Article < ApplicationRecord
  validates :title, presence: true, length: { minimum: 15 }, uniqueness: true
  validates :body, presence: true, length: { minimum: 100 }
  validates :username, format: { with: /regex/ }
end
