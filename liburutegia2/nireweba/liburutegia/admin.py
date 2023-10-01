from django.contrib import admin
from .models import Kokalekua, Liburua, LiburuKokalekua
# Register your models here.

class KokalekuaAdmin(admin.ModelAdmin):
    list_display = ['izena', 'pisua', 'sortua']
    prepopulated_fields = {'pisua': ('izena',)}

admin.site.register(Kokalekua, KokalekuaAdmin)

class LiburuaAdmin(admin.ModelAdmin):
    list_display = ['titulua', 'egilea', 'orrialde_kopurua', 'generoa']
    prepopulated_fields = {'egilea': ('egilea',)}

admin.site.register(Liburua, LiburuaAdmin)

class LiburuKokalekuaAdmin(admin.ModelAdmin):
    list_display = ('liburua', 'kokalekua')  # Define los campos que deseas mostrar en la lista

admin.site.register(LiburuKokalekua, LiburuKokalekuaAdmin)