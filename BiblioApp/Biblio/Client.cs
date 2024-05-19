using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Biblio
{
    public partial class Client : Form
    {
        MySqlConnection conn;
        string myConnectionString = "server=localhost;uid=root;pwd=;database=biblio";
        MySqlCommand cmd;
        MySqlDataReader dr;
        private int selected_id;

        public Client()
        {
            InitializeComponent();
        }
        private void displaydata()
        {
            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                dataGridView3.DataSource = null;
                ////disponible ouvrage
                MySqlDataAdapter adapter3 = new MySqlDataAdapter("SELECT id,name,cin,email,phone FROM `users`"
                 , conn);
                DataTable dt3 = new DataTable();
                adapter3.Fill(dt3);
                dataGridView3.DataSource = dt3;
                dataGridView3.Columns[0].HeaderText = "Id";
                dataGridView3.Columns[1].HeaderText = "Nom";
                dataGridView3.Columns[2].HeaderText = "Cin";
                dataGridView3.Columns[3].HeaderText = "Email";
                dataGridView3.Columns[4].HeaderText = "Phone";
                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }
        private void Client_Load(object sender, EventArgs e)
        {
            button2.Enabled = false;
            button3.Enabled = false;
            displaydata();
        }
        private void button1_Click(object sender, EventArgs e)
        {
            try
            {
                //errormessage
                if (String.IsNullOrWhiteSpace(textBox1.Text) || 
                    String.IsNullOrWhiteSpace(textBox2.Text) ||
                    String.IsNullOrWhiteSpace(textBox3.Text) ||
                    String.IsNullOrWhiteSpace(textBox4.Text) )
                {
                    label2.Text = "Remplire les information de client";
                }
                else
                {
                    conn = new MySqlConnection();
                    conn.ConnectionString = myConnectionString;
                    conn.Open();
                    String req = "select count(*) as nb from users where (email like @email or name like @name)";
                    cmd = new MySqlCommand(req, conn);
                    cmd.Parameters.AddWithValue("@email", textBox3.Text);
                    cmd.Parameters.AddWithValue("@name", textBox1.Text);
                    int data = int.Parse(cmd.ExecuteScalar().ToString());
                    if (data == 0)
                    {
                        String req2 = "INSERT INTO `users`(`name`, `cin`, `email`, `phone`) VALUES " +
                        " (@name,@cin,@email,@phone)";
                        cmd = new MySqlCommand(req2, conn);
                        cmd.Parameters.AddWithValue("@name", textBox1.Text);
                        cmd.Parameters.AddWithValue("@cin", textBox2.Text);
                        cmd.Parameters.AddWithValue("@email", textBox3.Text);
                        cmd.Parameters.AddWithValue("@phone", textBox4.Text);
                        cmd.ExecuteNonQuery();
                        conn.Close();
                        displaydata();
                    }
                    else
                    {
                        label2.Text = "ce client est déja enregistrer";
                    }
                  
                }
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void usersToolStripMenuItem_Click(object sender, EventArgs e)
        {
          
        }

        private void dataGridView3_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (dataGridView3.SelectedRows[0].Cells["Id"].Value.ToString() != "")
            {
                selected_id = int.Parse(dataGridView3.SelectedRows[0].Cells["Id"].Value.ToString());
                textBox1.Text = dataGridView3.SelectedRows[0].Cells["name"].Value.ToString();
                textBox2.Text = dataGridView3.SelectedRows[0].Cells["cin"].Value.ToString();
                textBox3.Text = dataGridView3.SelectedRows[0].Cells["email"].Value.ToString();
                textBox4.Text = dataGridView3.SelectedRows[0].Cells["phone"].Value.ToString();

                button2.Enabled = true;
                button3.Enabled = true;
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (selected_id != null)
            {
                try
                {
                    conn = new MySqlConnection();
                    conn.ConnectionString = myConnectionString;
                    conn.Open();
                    String req = " DELETE FROM `users` WHERE id = @id";

                    cmd = new MySqlCommand(req, conn);
                    cmd.Parameters.AddWithValue("@id", selected_id);
                    cmd.ExecuteNonQuery();
                    conn.Close();
                    displaydata();

                }
                catch (MySql.Data.MySqlClient.MySqlException ex)
                {
                    MessageBox.Show(ex.Message);
                }
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (selected_id != null)
            {
                try
                {
                    //errormessage
                    if (String.IsNullOrWhiteSpace(textBox1.Text) ||
                        String.IsNullOrWhiteSpace(textBox2.Text) ||
                        String.IsNullOrWhiteSpace(textBox3.Text) ||
                        String.IsNullOrWhiteSpace(textBox4.Text))
                    {
                        label2.Text = "Remplire les information de client";
                    }
                    else
                    {
                        conn = new MySqlConnection();
                        conn.ConnectionString = myConnectionString;
                        conn.Open();
                        String req = "select count(*) as nb from users where (email like @email or name like @name)";
                        cmd = new MySqlCommand(req, conn);
                        cmd.Parameters.AddWithValue("@email", textBox3.Text);
                        cmd.Parameters.AddWithValue("@name", textBox1.Text);
                        int data = int.Parse(cmd.ExecuteScalar().ToString());
                        if (data == 0)
                        {
                            String req2 = " UPDATE `users` SET `name`=@name,`email`=@email,`cin`=@cin,`phone`=@phone WHERE id = @id";
                            cmd = new MySqlCommand(req2, conn);
                            cmd.Parameters.AddWithValue("@name", textBox1.Text);
                            cmd.Parameters.AddWithValue("@cin", textBox2.Text);
                            cmd.Parameters.AddWithValue("@email", textBox3.Text);
                            cmd.Parameters.AddWithValue("@phone", textBox4.Text);
                            cmd.Parameters.AddWithValue("@id", selected_id);
                            cmd.ExecuteNonQuery();
                            conn.Close();
                            label2.Text = "";

                            displaydata();
                        }
                        else
                        {
                            label2.Text = "ce client est déja enregistrer";
                        }

                    }
                }
                catch (MySql.Data.MySqlClient.MySqlException ex)
                {
                    MessageBox.Show(ex.Message);
                }
            }
        }

        private void dataGridView3_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }

        private void hoToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Home form = new Home();
            form.Show();
        }

        private void ouvragesToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Ouvrage form = new Ouvrage();
            form.Show();

        }

        private void emprintsToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Hide();
            Emprint form = new Emprint();
            form.Show();
        }

        private void menuStrip1_ItemClicked(object sender, ToolStripItemClickedEventArgs e)
        {

        }
    }
}
