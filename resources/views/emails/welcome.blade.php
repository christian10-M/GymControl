@component('mail::message')

# ¡Bienvenido {{ $user->name }}!

Nos alegra que formes parte de nuestro gimnasio

Tu registro se realizó correctamente.

## Datos de acceso

* **Clave de acceso:** {{ $user->access_key }}
* **Correo:** {{ $user->email }}

## Datos de la membresia

* **Tipo:** {{ $user->activeMembership->type }}
* **Fecha inicio:** {{ $user->activeMembership->start_date }}
* **Fecha corte:** {{ $user->activeMembership->end_date }}

Gracias por confiar en nosotros.

@component('mail::button', ['url' => config('app.url')])
Visitar sitio
@endcomponent

Saludos,<br>
{{ config('app.name') }}

@endcomponent
