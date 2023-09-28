from django.contrib import admin
from .models import Post

# Register your models here.
class PostAdmin(admin.ModelAdmin):
    list_display = ['izenburua', 'edukia', 'noizsortua']

admin.site.register(Post, PostAdmin)