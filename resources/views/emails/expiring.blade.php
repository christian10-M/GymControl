@component('mail::message')

# Hola {{ $user->name }}

Te recordamos que tu membresía del gimnasio vence mañana.

## Datos de tu membresía

* **Tipo:** {{ $user->activeMembership->type }}

* **Fecha de vencimiento:**
  {{ $user->activeMembership->end_date->format('d/m/Y') }}

Acude al gimnasio para poder renovar tu membresía y puedas seguir disfrutando de todos los beneficios

@component('mail::button', ['url' => config('app.url')])
Ir al sitio
@endcomponent

Gracias,<br>
{{ config('app.name') }}

@endcomponent
