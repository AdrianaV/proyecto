namespace proyecto.Views;

public partial class mapa : ContentPage
{
    String usuario;
	public mapa(String user)
	{
		InitializeComponent();
        lblUsuario.Text = user;
        usuario = user;
    }

    private void btnBuscar_Clicked(object sender, EventArgs e)
    {
        Navigation.PushAsync(new negocios(usuario));

    }
}