namespace proyecto.Views;

public partial class detalle : ContentPage
{
	public detalle(Modelos.Usuario negocio, String user)
	{
		InitializeComponent();
        lblUsuario.Text = user;
        lblUbicacion.Text = negocio.ubicacion;
        lblNegocio.Text = negocio.negocio;
        lblDetalle.Text = negocio.detalle;
        lblReferencia.Text = negocio.referencias;
    }
}